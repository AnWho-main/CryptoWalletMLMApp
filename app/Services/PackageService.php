<?php

namespace App\Services;
use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Http\Request;
use Log;
use Exception;
use App\Models\member\MasterProduct;
use App\Models\member\ClientTransactions;
use App\Models\member\ClientProfile;
use App\Models\member\MemberProfile;
use App\Models\member\ClientInvestment;
use App\Models\member\MasterCompanyAccount;


Use Session;
use Carbon\Carbon;
use App\Services\HelperService;

class PackageService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';

        $this->helperService = new HelperService();
    }

    public function ShowPackData($type)
    {
        $data =  MasterProduct::where('show_status', 1)->get();
        $client_id = Session::get('loginID');
        $pack = ClientProfile::where('client_id',$client_id)->first();
        $date = date('Y-m-d');

        $blimit = MasterProduct::where('prod_id',$pack->current_package)->first('boosting_allowed');
        
        if(!empty($blimit)){
          $boostLimit = $blimit->boosting_allowed;       
        }else{
          $boostLimit = 0;  
        }
      
        $boost = ClientInvestment::where('client_id',$client_id)
        ->where('investment_type',"boosting")
        ->where('activation_date',$date)->count();       

        // echo $pack->current_package;
        // die();

        $aAddress = MasterCompanyAccount::where('id',1)->first();
        return ['upd'=>$data,'type'=>$type,'pack'=>$pack,'boost'=>$boost,'aAddress'=>$aAddress,'boostLimit'=>$boostLimit];
    }

    public function Buypackage(Request $request){

        $adr =  "$request->uadr";
        $pac =  $request->pack;
        $pa = explode('-', $pac);
        $pack = $pa[0];
        $amount = $pa[1];

        $txnid =  $request->txnid;
        $date = date('Y-m-d h:i:s');
        $cdate = date('Y-m-d');
        $time = time();
        
        $pid = $pack;
        
        $client_id = Session::get('loginID');
        
          $udata = ClientProfile::where('client_id',$client_id)->first();
          
          try {
            \DB::beginTransaction();

          if($udata->current_package == 0){
              $updt = ClientProfile::where('client_id',$client_id)
              ->update(['activation_status'=>1,
              'activation_date'=>$cdate,
              'activation_time'=>$time,
              'current_package'=>$pid,
              'activation_product_id'=>$pid,
              'activation_package_cost'=>$amount,
              'updated_at'=>$date]);
          }else{
                $updt = ClientProfile::where('client_id',$client_id)
              ->update(['current_package'=>$pid,'updated_at'=>$date]);
          }
        
        $regis = new ClientTransactions();
        $regis->wallet_type = "main";
        $regis->amount_type = "Debit";
        $regis->wallet_address = $adr;
        $regis->package = $pid;
        $regis->client_id = $client_id;
        $regis->user_id = $udata->id;
        $regis->client_id_from = $udata->client_intro_id;
        $regis->status = 'success';
        $regis->amount = $amount;
        $regis->message = "Buy package";
        $regis->txn_no = $txnid;
        $regis->created_at = $date;

        $regis->save();
        
        $tid = $regis->id;
        
        
        $inves = new ClientInvestment();
        $inves->investment_type = "package";
        $inves->product_id_fk = $pid;
        $inves->transaction_ref = $tid;
        $inves->user_id = $udata->id;
        $inves->client_id = $client_id;
        $inves->activation_date = $cdate;
        $inves->activation_time = $time;
        $inves->created_at = $date;
        $inves->save();

        $productData = MasterProduct::where('prod_id',$pid)->first('cost');
        $productCost = $productData->cost;

        $adminProfit = (5/100)*$productCost;
        $dtt = date("Y-m-d h:i:s");
        $dt = date("Y-m-d");

        $this->helperService->transactionEntryUpdate(1,0,'CTHUB101010','0',$adminProfit,'8','1', "adminPackageIncome",'main','Credit','main_wallet',"Admin Package Income",$dt,$dtt);

        \DB::commit();

        $edata = MemberProfile::where('client_id',$client_id)->first();

        $param = [];
        $param['name'] = $edata->m_name;
        $param['email'] = $edata->m_email;
        $param['mobile'] = $edata->m_mobile;
        $param['amount'] = $amount;
         
        /*
        
        TODO send email and sms - place code here 

        */ 

        return response()->json(['message' => "Congratulations! Package purchase successfully"]);

    } catch (Exception $e) {
        \DB::rollBack();
        $except['status']           = false;
        $except['error'][]          = 'Exception Error...';
        $except['message']          = $e;
        $exception                  = new BaseController();
        $exception                  = $exception->throwExceptionError($except, 500);
    }
        
    }

    public function BuyBoosting(Request $request){

        $adr =  "$request->uadr";
        $pac =  $request->pack;
        $pa = explode('-', $pac);
        $pack = $pa[0];
        $amount = $pa[1];

        $txnid =  $request->txnid;
        $date = date('Y-m-d h:i:s');
         $cdate = date('Y-m-d');
        $time = time();
        
        $pid = $pack;
        
       $dcheck =  ClientTransactions::where('txn_no',$txnid)->first();
       if(!empty($dcheck)){
        return response()->json(['message' => "Dublicate entry stop!"]);  
       }
        
        $client_id = Session::get('loginID');
      $udata = ClientProfile::where('client_id',$client_id)->first();
      
      try {
        \DB::beginTransaction();
      
      if($udata->boosting_status == 0){
              $updt = ClientProfile::where('client_id',$client_id)
              ->update(['boosting_status'=>1,'boosting_date'=>$cdate,'boosting_time'=>$time,'updated_at'=>$date]);
          }
      

        $regis = new ClientTransactions();
        $regis->wallet_type = "main";
        $regis->amount_type = "Debit";
        $regis->wallet_address = $adr;
        $regis->package = $pid;
        $regis->client_id = $client_id;
        $regis->user_id = $udata->id;
        $regis->client_id_from = $udata->client_intro_id;
        $regis->status = 'success';
        $regis->amount = $amount;
        $regis->message = "For boosting";
        $regis->txn_no = $txnid;
        $regis->created_at = $date;
        $regis->save();
        
        $tid = $regis->id;
        
        $inves = new ClientInvestment();
        $inves->investment_type = "boosting";
        $inves->product_id_fk = $pid;
        $inves->transaction_ref = $tid;
        $inves->user_id = $udata->id;
        $inves->client_id = $client_id;
        $inves->activation_date = $cdate;
        $inves->activation_time = $time;
        $inves->created_at = $date;
        $inves->save();
        
        \DB::commit();

        $edata = MemberProfile::where('client_id',$client_id)->first();

        $param = [];
        $param['name'] = $edata->m_name;
        $param['email'] = $edata->m_email;
        $param['mobile'] = $edata->m_mobile;
        $param['amount'] = $amount;
         
        /*
        
        TODO send email and sms - place code here 

        */ 

        return response()->json(['message' => "Congratulations! Boosting successfully done"  ]);

    } catch (Exception $e) {
        \DB::rollBack();
        $except['status']           = false;
        $except['error'][]          = 'Exception Error...';
        $except['message']          = $e;
        $exception                  = new BaseController();
        $exception                  = $exception->throwExceptionError($except, 500);
    }

    }

}