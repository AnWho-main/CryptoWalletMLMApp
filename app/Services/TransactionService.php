<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\member\MemberProfile;
use App\Models\member\ClientProfile;
use App\Models\member\ClientTransactions;
use App\Models\member\MasterCountry;
use Log;
use Exception;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class TransactionService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
    }

    public function getAllTransaction($request)
    {
        $pagArray = config('global.pagingListArray');
        if ($request->input('per_page_selected') != "") {
            $per_page_selected = $request->input('per_page_selected');
        } else {
            $per_page_selected = $pagArray[0];
        }
        $whereCondition = [];

        if(!empty($request->input('reportrange'))){
            $dateRange = $request->input('reportrange');
         
           // Split the date range into start and end dates
           list($startDate, $endDate) = explode(' - ', $dateRange);

           // Convert the date strings to valid date objects
           $startDat = \Carbon\Carbon::parse($startDate)->startOfDay();
           $endDat = \Carbon\Carbon::parse($endDate)->endOfDay();
        }

              if(!empty($startDat)){
                 $startDate = $startDat;
                 $endDate = $endDat;
              }else{
                 $startDate = Carbon::now()->startOfMonth(); // Start of the current month
                 $endDate = Carbon::now(); // The current date is the end date                  
              }

        if (!empty($request->input('amount_type'))) {
            $whereCondition[] = ['client_transactions.amount_type', 'LIKE', $request->input('amount_type') . '%'];
        }

        if (!empty($request->input('datefrom'))) {
            $whereCondition[] = ['client_transactions.created_at', '>=', $request->input('datefrom')];
        }
        if (!empty($request->input('dateto'))) {
            $whereCondition[] = ['client_transactions.created_at', 'LIKE', $request->input('dateto') . '%'];
        }

        $client_id = Session::get('loginID');
        $data = ClientTransactions::join('client_profile_personals', 'client_transactions.client_id', '=', 'client_profile_personals.client_id')
            ->select('client_profile_personals.m_name', 'client_transactions.*')
            ->where($whereCondition)
            ->whereBetween('client_transactions.created_at', [$startDate, $endDate->endOfDay()]) 
            ->where('client_transactions.client_id', '=', $client_id)
            ->orderBy('client_transactions.id', 'DESC')
            ->paginate($per_page_selected);

            // reporting

            // for graph
            $dailyTransSum = ClientTransactions::where('client_id', $client_id)
            ->select(DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y")  as day'), DB::raw('SUM(amount) as total_amount'))
            // ->whereMonth('created_at', $currentMonth)
            ->whereBetween('created_at', [$startDate, $endDate->endOfDay()])
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y")'))
            ->get();

             // for total
             $ClientTransactions[0] = ClientTransactions::where('client_id', $client_id)
             ->where('status','success')
             ->sum('amount');
 
             // for current month
             $wstartDate = Carbon::now()->startOfMonth(); // Start of the current month
             $wendDate = Carbon::now(); // The current date is the end date        
             $ClientTransactions[1] = ClientTransactions::where('client_id', $client_id)
             ->whereBetween('created_at', [$wstartDate, $wendDate->endOfDay()])
             ->where('status','success')
             ->sum('amount');
 
             // for today
             $ClientTransactions[2] = ClientTransactions::where('client_id', $client_id)
             ->whereDate('created_at',$wendDate )
             ->where('status','success')
             ->sum('amount');

        return  ['rsd' => $data,'ClientTransactions'=>$ClientTransactions,'dailyTransSum'=>$dailyTransSum];
    }
}
