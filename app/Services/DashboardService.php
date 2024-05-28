<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\member\MemberProfile;
use Log;
use App\Models\member\ClientProfile;
use App\Models\member\NewsAndEvent;
use App\Models\member\ClientPayout;
use App\Models\member\ClientInvestment;
use App\Models\member\ClientWithdrawal;
use App\Models\member\MasterProduct;
use App\Models\member\MasterCompanyAccount;
use App\Models\member\ClientAchievers;
use App\Models\Site\CmsFaqModel as Faqs;
use App\Models\member\ClubBoosting1;
use App\Models\member\ClientTransactions;
use Exception;
use App\Services\HelperService;

Use Session;
use Carbon\Carbon;

class DashboardService
{

    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';

        $this->helperService = new HelperService();
    }

    /**
     * @method getAllUser()
     * 
     * @param 
     * $request 
     * 
     * @response
     * 
     * member report 
     * income report
     * member report 
     * dashboard related data
     */

    public function DashboardData()
    {
       
        $ses = Session::get('loginID');
        $suserID = Session::get('userID');
       
       $data = MemberProfile::join('client_profile_accounts', 'client_profile_personals.id', '=', 'client_profile_accounts.id')
     ->select('client_profile_personals.*', 
             'client_profile_accounts.client_intro_id as cintro',
             'client_profile_accounts.boosting_date as boostingdate',
             'client_profile_accounts.activation_date as activedate',
             'client_profile_accounts.main_wallet as mainwallet',
            //  'client_profile_accounts.autopool_wallet as autopoolwallet',
             'client_profile_accounts.boosting_wallet as boostingwallet',
             'client_profile_accounts.activation_status as activestatus',
             'client_profile_accounts.current_package as currentPack',
             'client_profile_accounts.wallet_address as userWalletAddress',
             'client_profile_accounts.created_at as created_at',
             'client_profile_accounts.activation_time as activation_time',
             'client_profile_accounts.boosting_time as boosting_time',
             'client_profile_accounts.join_date as cjoin')
             ->where('client_profile_accounts.client_id',$ses)
             ->first();
     
     $events = NewsAndEvent::where('event_type','NewsEvent')
                      ->where('publish_status', 1)
                      ->where('display_on','member')
                      ->orWhere('display_on','all')
                      ->orderBy('sequence_no')
                      ->get();
   
    $trans = ClientTransactions::where('client_id',$ses)
                      ->orderBy('id','DESC')
                      ->limit(10)
                      ->get();

   $withdraws = ClientWithdrawal::where('client_id',$ses)
                      ->orderBy('id','DESC')
                      ->limit(10)
                      ->get();
                          
    $faqs = Faqs::where('publish_status',1)
                      ->orderBy('sequence_no')
                      ->get();
 
   $cbt = ClubBoosting1::where('client_id',$ses)
   ->where('package',9)
   ->orderBy('id','DESC')
   ->first();                  
                      
     $pack = [];
     $pack[0] = MasterProduct::where('show_status',1)
                      ->where('fk_cid',1)
                      ->count();
                      
     $pack[1] = ClientInvestment::where('client_id',$ses)
                      ->where('investment_type','boosting')
                      ->count();      
                      
     $pack[2] = ClubBoosting1::where('client_id',$ses)
                      ->where('b_completion',1)
                      ->count();
 
     $pack[3] = ClientPayout::where('user_id',$data->id)
                      ->where('income_type','boosting')
                      ->where('pay_status',0)
                      ->count();               
                     
       $bpay = ClientPayout::where('user_id',  $data->id)
                      ->where('income_type', 'boosting')
                      ->orderBy('id', 'DESC')
                      ->first();                 
                      
    $join = MemberProfile::orderBy('id','DESC')
                      ->limit(6)
                      ->get();

    $achievers = ClientAchievers::orderBy('id','DESC')
                      ->limit(6)
                      ->get();
 
    $tom =  ClientWithdrawal::where('client_id',$ses)->where('status','Approved')->sum('amount');
        
                      $repo = [];
                       foreach(config('global.incomeTypesArray') as $key => $value){
                         $repo[$value[1]] =  ClientPayout::where('income_type',$key)
                         ->where('user_id',$suserID)
                         ->sum('total_commission'); 
                       }
           
                       $cdata = MasterCompanyAccount::where('id',1)->first();
                           $amt = 0;
                           $TLid = 0;
                           $WLid = 0;
                       if($data->kyc_status == "approved" && $data->withdraw_status == 1){
                           if($data->mainwallet >= 8){
                             if($cdata->show_status == 1){            
                                         $cdata = MasterCompanyAccount::where('id',1)->first();
                                         $uamt = ClientProfile::where('client_id',$ses)->first();
                                        $amount = $uamt->main_wallet;
                                        $deAmount = $amount - ($amount * 15/100);
                                         $amt =   $deAmount;

                                         $adminProfit = $amount * 15/100;
                                         $dtt = date("Y-m-d h:i:s");
                                         $dt = date("Y-m-d");
                                 
                                         $this->helperService->transactionEntryUpdate(1,0,'CTHUB101010','0',$adminProfit,'8','1', "adminWithdrawalIncome",'main','Credit','main_wallet',"Admin Withdraw Income",$dt,$dtt);
 
                                         $date = date('Y-m-d h:i:s');
 
                                         $regis = new ClientTransactions();
                                         $regis->wallet_type = "main";
                                         $regis->amount_type = "Credit";
                                         $regis->wallet_address = $data->userWalletAddress;
                                         $regis->package = 0;
                                         $regis->client_id =  $ses;
                                         $regis->user_id = $uamt->id;
                                         $regis->status = 'pending';
                                         $regis->amount =  $amt;
                                         $regis->message = "Withdrawal";
                                         $regis->created_at = $date;
                                         $regis->save();
                                         $TLid = $regis->id;
 
                                         $reg = new ClientWithdrawal();
                                         $reg->type_trans = "Credit";
                                         $reg->wallet_address	 = $data->userWalletAddress;
                                        //  $reg->bank_name = 'BEP20';
                                         $reg->client_id =  $ses;
                                         $reg->user_id = $uamt->id;
                                         $reg->m_name = $data->m_name;
                                         $reg->amount =  $amt;
                                         $reg->withdrawal_amount = $uamt->main_wallet;
                                         $reg->status = "Pending";
                                         $reg->created_at = $date;
                                         $reg->save();
                                         $WLid = $reg->id;
 
                                         $ua = ClientProfile::where('client_id',$ses)->update(['main_wallet'=>0]);
                             }
                           }
                       }   
 
                   $tabName = 'ClientProfile';
                   $colClient = 'client_id';
                   $colParent = 'parent_id';
                   $parentArray[] = $ses;
 
                 $totalDownline = \AppHelper::instance()->getAllTeam($tabName, $colClient, $colParent, $parentArray); 
                 
                 // $totalDownline =  $totalDownline.pop(0);
                 $elementToRemove = $ses;
 
                 $filteredArray = collect($totalDownline)->reject(function ($item) use ($elementToRemove) {
                   return $item === $elementToRemove;
               })->values();
 
               $totalDownline =   $filteredArray;
 
                 // echo"<pre>";
                 // print_r($filteredArray);
                 // echo"</pre>";
                 // die();
 
                 $memRepo[0] = count($totalDownline);  
 
                 $totalDownlineMembers = ClientProfile::selectRaw("GROUP_CONCAT(QUOTE($colClient)) as Ids")
                 ->whereIn('client_id',$totalDownline)
                 ->where('activation_status',1)
                 ->get()
                 ->pluck('Ids')
                 ->first();
 
                 if(!empty($totalDownlineMembers)){
                   $arrayDownlineActive = explode(',', str_replace("'", '', $totalDownlineMembers));
                 }else{
                   $arrayDownlineActive = []; 
                 }
                 $memRepo[1] = count($arrayDownlineActive);  
 
 
                 $totalDownlineMembersIn = ClientProfile::selectRaw("GROUP_CONCAT(QUOTE($colClient)) as Ids")
                 ->whereIn('client_id',$totalDownline)
                 ->where('activation_status',0)
                 ->get()
                 ->pluck('Ids')
                 ->first();
 
                 if(!empty($totalDownlineMembersIn)){
                   $arrayDownlineInactive = explode(',', str_replace("'", '', $totalDownlineMembersIn));
                 }else{
                   $arrayDownlineInactive = []; 
                 }
                 $memRepo[2] = count($arrayDownlineInactive);  
 
 
                 // echo"<pre>";
                 // print_r( $memRepo[2] );
                 // echo"</pre>";
                 // die();
 
               
                 // $memRepo[2] =  $memRepo[0] - $memRepo[1];  
 
                 $totalDownlineMembers = ClientProfile::selectRaw("GROUP_CONCAT(QUOTE($colClient)) as Ids")
                 ->whereIn('client_id',$totalDownline)
                 ->where('activation_status',1)
                 ->get()
                 ->pluck('Ids')
                 ->first();
 
                 $arrayDownlineActive = explode(',', str_replace("'", '', $totalDownlineMembers));
 
                 $startDate = Carbon::now()->startOfMonth(); // Start of the current month
                 $endDate = Carbon::now(); // The current date is the end date          
                 $totalDownlineBtw = ClientProfile::selectRaw("GROUP_CONCAT(QUOTE($colClient)) as Ids")
                 ->whereIn('client_id',$totalDownline)
                 ->whereBetween('created_at', [$startDate, $endDate])
                 ->get()
                 ->pluck('Ids')
                 ->first();
              
                 if(!empty($totalDownlineBtw)){
                   $arrayDownline = explode(',', str_replace("'", '', $totalDownlineBtw));
                 }else{
                   $arrayDownline = [];
                 }
                 $memRepo[3] = count($arrayDownline);   
 
                 $totalDownlineActBtw = ClientProfile::selectRaw("GROUP_CONCAT(QUOTE($colClient)) as Ids")
                 ->whereIn('client_id',$totalDownline)
                 ->whereBetween('created_at', [$startDate, $endDate])
                 ->where('activation_status',1)
                 ->get()
                 ->pluck('Ids')
                 ->first();
              
                 if(!empty($totalDownlineActBtw)){
                   $arrayDownline = explode(',', str_replace("'", '', $totalDownlineActBtw));
                 }else{
                   $arrayDownline = [];
                 }
                 $memRepo[4] = count($arrayDownline);   
 
                 $totalDownlineInActBtw = ClientProfile::selectRaw("GROUP_CONCAT(QUOTE($colClient)) as Ids")
                 ->whereIn('client_id',$totalDownline)
                 ->whereBetween('created_at', [$startDate, $endDate])
                 ->where('activation_status',0)
                 ->get()
                 ->pluck('Ids')
                 ->first();
              
                 if(!empty($totalDownlineInActBtw)){
                   $arrayDownline = explode(',', str_replace("'", '', $totalDownlineInActBtw));
                 }else{
                   $arrayDownline = [];
                 }
                 $memRepo[5] = count($arrayDownline);   
 
 
                 $memDirectRepo[0] = ClientProfile::where('client_intro_id',$ses)
                 ->count();
 
                 $memDirectRepo[1] = ClientProfile::where('client_intro_id',$ses)
                 ->where('activation_status',1)
                 ->count();
 
                 $memDirectRepo[2] = ClientProfile::where('client_intro_id',$ses)
                 ->where('activation_status',0)
                 ->count();

        return ['nds'=>$data,'events'=>$events,'trans'=>$trans,'achievers'=>$achievers,'withdraws'=>$withdraws,'faqs'=>$faqs,'join'=>$join,'repo'=>$repo,'pack'=>$pack,'cdata'=>$cdata,'amt'=>$amt,'ids'=>[$TLid,$WLid],'tom'=>$tom,'cbt'=>$cbt,'bpay'=>$bpay,'memRepo'=>$memRepo,'memDirectRepo'=>$memDirectRepo];
    }

    public function withdrawMember(Request $request){
      $ses = Session::get('loginID');
      $Tlid =  $request->tlid;
      $Wlid =  $request->wlid;
      $txid =  $request->txnid;
      $date = date('Y-m-d h:i:s');

      $regis = ClientTransactions::where('id',$Tlid)->update(['txn_no'=>$txid,'status'=>"success",'updated_at'=>$date]);
     
      $regis =  ClientWithdrawal::where('id',$Wlid)->update(['txn_id'=>$txid,'status'=>"Approved",'updated_at'=>$date]);

      $edata = MemberProfile::where('client_id',$ses)->first();

      $param = [];
      $param['name'] = $edata->m_name;
      $param['email'] = $edata->m_email;
      $param['mobile'] = $edata->m_mobile;
      $param['txnId'] = $txid;
       
      /*
      
      TODO send email and sms -  for withdrwal 

      */ 
       
      return response()->json(['message' => "Congratulations! Transaction successfully done"  ]);
     }

}
