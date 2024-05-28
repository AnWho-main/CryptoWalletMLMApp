<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Services\DashboardService;
use App\Models\member\ClientWithdrawal;
use App\Models\member\ClientTransactions;

Use Session;
use Carbon\Carbon;

class DashboardController extends Controller
{

  public function __construct()
  {
      $this->DashboardService = new DashboardService();
  }

    /**
     * Display data related to dashboard.
     */

    public function showdashboard()
    {     
       return view("/".config('app.member_folder')."/dashboard/show", $this->DashboardService->DashboardData());   
    }

    // public function withdraw(Request $request){
    //   return $this->DashboardService->withdrawMember($request);
    //  }



    public function withdraw(Request $request){
        $ses = Session::get('loginID');
        $Tlid =  $request->tlid;
        $Wlid =  $request->wlid;
        $txid =  $request->txnid;
        $date = date('Y-m-d h:i:s');
  
        $regis = ClientTransactions::where('id',$Tlid)->update(['txn_no'=>$txid,'status'=>"success",'updated_at'=>$date]);
       
        $regiss =  ClientWithdrawal::where('id',$Wlid)->update(['txn_id'=>$txid,'status'=>"Approved",'updated_at'=>$date]);
         
        return response()->json(['message' => "Congratulations! Transaction successfully done"  ]);
       }
       

}
