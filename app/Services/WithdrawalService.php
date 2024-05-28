<?php

namespace App\Services;


use App\Models\member\ClientWithdrawal;

use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class WithdrawalService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
    }

    public function getWithdrawal($request)
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

        if (!empty($request->input('client_id'))) {
            $whereCondition[] = ['client_withdrawals.client_id', 'LIKE', $request->input('client_id') . '%'];
        }
        if (!empty($request->input('status'))) {
            $whereCondition[] = ['client_withdrawals.status', 'LIKE', $request->input('status') . '%'];
        }

        if (!empty($request->input('datefrom'))) {
            $whereCondition[] = ['client_withdrawals.created_at', '>=', $request->input('datefrom')];
        }
        if (!empty($request->input('dateto'))) {
            $whereCondition[] = ['client_withdrawals.created_at', '<=', date('Y-m-d', strtotime($request->input('dateto') . "+1 days"))];
        }

        $client_id = Session::get('loginID');
     
        $data = ClientWithdrawal::where($whereCondition)
            ->where('client_id', $client_id)   
            ->whereBetween('created_at', [$startDate, $endDate->endOfDay()]) 
            ->orderBy('id', 'DESC')
            ->paginate($per_page_selected);

            // reporting

            // for graph
            $dailyWithdrawSum = ClientWithdrawal::where('client_id', $client_id)
            ->select(DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y")  as day'), DB::raw('SUM(withdrawal_amount) as total_amount'))
            // ->whereMonth('created_at', $currentMonth)
            ->whereBetween('created_at', [$startDate, $endDate->endOfDay()])
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%d/%m/%Y") '))
            ->get();

            // for total
            $ClientWithdrawals[0] = ClientWithdrawal::where('client_id', $client_id)
            ->where('status','Approved')
            ->sum('withdrawal_amount');

            // for current month
            $wstartDate = Carbon::now()->startOfMonth(); // Start of the current month
            $wendDate = Carbon::now(); // The current date is the end date        
            $ClientWithdrawals[1] = ClientWithdrawal::where('client_id', $client_id)
            ->whereBetween('created_at', [$wstartDate, $wendDate->endOfDay()])
            ->where('status','Approved')
            ->sum('withdrawal_amount');

            // for today
            $ClientWithdrawals[2] = ClientWithdrawal::where('client_id', $client_id)
            ->whereDate('created_at',$wendDate )
            ->where('status','Approved')
            ->sum('withdrawal_amount');

        return ['rsd' => $data,'ClientWithdrawals' => $ClientWithdrawals,'dailyWithdrawSum'=>$dailyWithdrawSum];
    }
}
