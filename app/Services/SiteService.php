<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\member\MemberProfile;
use Log;
use App\Models\Site\CmsBlogModel;
use App\Models\Site\CmsFaqModel;
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
use App\Models\Site\ClientAchiversModel;
use App\Models\Site\CmsContactusModel;
use App\Models\Site\CmsEventModel;
use App\Models\member\ClientDirector;
use Exception;
use App\Services\HelperService;

Use Session;
use Carbon\Carbon;

class SiteService
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
     * site report 
     * income report
     * member report 
     * site related data
     */
     
     public function BlogDetailData(){
      $blogDetails = CmsBlogModel::where('publish_status',1)
      ->where('id',$id)
      ->where('display_on','all')
      ->orWhere('display_on','website')
      ->orderBy('sequence_no','DESC')
      ->first();
      $recentPost = CmsBlogModel::where('publish_status',1)
      ->where('id','!=',$id)
      ->where('display_on','all')
      ->orWhere('display_on','website')
      ->inRandomOrder()
      ->take(5)
      ->get();
      return compact('blogDetails','recentPost');
     }

     public function BlogListData(){
      $blogList = CmsBlogModel::where('publish_status',1)
      ->where('display_on','all')
      ->orWhere('display_on','website')
      ->orderBy('sequence_no','DESC')
      ->paginate(3);
      $recentPost = CmsBlogModel::where('publish_status',1)
      ->where('display_on','all')
      ->orWhere('display_on','website')
      ->inRandomOrder()
      ->take(5)
      ->get();

      return compact('blogList','recentPost');
     }

     public function Faqs(){
      $faqs = CmsFaqModel::where('publish_status',1)
      ->where('display_on','all')
      ->orWhere('display_on','website')
      ->orderBy('sequence_no','DESC')
      ->get();
      return compact('faqs');
     }

     public function SiteContact(Request $request){
      $request->validate([
        "name" => "required",
        "subject" => "required",
        "email" => "required",
        "mobile" => "required",
        "msg" => "required",
    ]);
    //send Email to Admin
    //inter record in cms_contatus table 
    $contact = new CmsContactusModel();
    $contact->name = $request->name;
    $contact->subject = $request->subject;
    $contact->email = $request->email;
    $contact->mobile = $request->mobile;
    $contact->message = $request->msg;
    $contact->save();
    return redirect()->route('contact-us')->with('success','Submit successfully');
  }

     public function SiteIndexData(){
      $clientAchivers = ClientAchiversModel::where('is_status',1)
      ->where('is_live',1)
      ->get();
      $news = CmsEventModel::where('publish_status',1)
      ->where('is_live',1)
      ->where('is_status',1)
      ->get();
      $activeMembers = ClientProfile::where('current_package','>',0)
      ->count('id');
  
      $CurrentDate = Carbon::now();

      //  total joining 
      $joiningReport[0] = $activeMembers;
       // total todays joining 
       $joiningReport[1] = ClientProfile::where('current_package','>',0)
       ->whereDate('created_at',$CurrentDate )
       ->where('is_live',1)
       ->where('is_status',1)
       ->count('id');

      //  total withdrawal

      // $joiningReport[2] = ClientWithdrawal::where('status','Approved')
      // ->where('is_live',1)
      // ->where('is_status',1)
      // ->sum('withdrawal_amount');

      // total todays withdrawal

      // $joiningReport[3] = ClientWithdrawal::where('status','Approved')
      // ->where('is_live',1)
      // ->where('is_status',1)
      // ->whereDate('created_at',$CurrentDate )
      // ->sum('withdrawal_amount');


      $joinReport = ClientWithdrawal::selectRaw('
      SUM(CASE WHEN status = "Approved" AND is_live = 1 AND is_status = 1 THEN withdrawal_amount ELSE 0 END) as total_withdrawal,
      SUM(CASE WHEN status = "Approved" AND is_live = 1 AND is_status = 1 AND DATE(created_at) = DATE(?)  THEN withdrawal_amount ELSE 0 END) as total_today_withdrawal
      ', [$CurrentDate])->first();

       //  total withdrawal
      $joiningReport[2] = $joinReport->total_withdrawal;
      // total todays withdrawal
      $joiningReport[3] = $joinReport->total_today_withdrawal;
 
      $BoostingReport = ClientInvestment::selectRaw('
      SUM(CASE WHEN investment_type = "boosting" AND is_live = 1 AND is_status = 1 THEN 1 ELSE 0 END) as total_boosting,
      SUM(CASE WHEN investment_type = "boosting" AND is_live = 1 AND is_status = 1 AND DATE(created_at) = DATE(?) THEN 1 ELSE 0 END) as total_today_boosting
     ', [$CurrentDate])->first();

      // total boosting
      $joiningReport[4] = $BoostingReport->total_boosting;
      // total todays boosting    
      $joiningReport[5] = $BoostingReport->total_today_boosting;

      $boostingRevReport = ClubBoosting1::selectRaw('
      SUM(CASE WHEN b_completion = 1 AND is_live = 1 AND is_status = 1 THEN 1 ELSE 0 END) as total_boosting_received,
      SUM(CASE WHEN b_completion = 1 AND is_live = 1 AND is_status = 1 AND DATE(created_at) = DATE(?) THEN 1 ELSE 0 END) as total_today_boosting_received
      ', [$CurrentDate])->first();

      // total boosting received
      $joiningReport[6] = $boostingRevReport->total_boosting_received;
      // total todays boosting received
      $joiningReport[7] = $boostingRevReport->total_today_boosting_received;
      
      // recent joining
      $rjoining = MemberProfile::orderBy('id','DESC')
      ->limit(6)
      ->get();

      
      return compact('clientAchivers','news','activeMembers','joiningReport','rjoining');
  
     }

    public function SiteReportData(Request $request)
    {
       
      $ses = $request->rid;

      $getRepoId= ClientProfile::where('client_id',$ses)->first(['id']);
      $suserID = $getRepoId->id;
     
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
      // Total Current Month
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
      // Current Month active
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
      // Current Month inactive
      $memRepo[5] = count($arrayDownline);   

      $memDirRepo = ClientProfile::selectRaw('
      COUNT(*) as total_direct_members,
      COUNT(CASE WHEN activation_status = 1 THEN 1 END) as total_active_members,
      COUNT(CASE WHEN activation_status = 0 THEN 1 END) as total_inactive_members
      ')->where('client_intro_id', $ses)->first(); 

      // Total Direct Members
      $memDirectRepo[0] = $memDirRepo->total_direct_members;

      // Direct Members active
      $memDirectRepo[1] = $memDirRepo->total_direct_members;

      // Direct Members inactive
      $memDirectRepo[2] = $memDirRepo->total_direct_members;

      return ['nds'=>$data,'events'=>$events,'trans'=>$trans,'achievers'=>$achievers,'withdraws'=>$withdraws,'faqs'=>$faqs,'join'=>$join,'pack'=>$pack,'tom'=>$tom,'cbt'=>$cbt,'bpay'=>$bpay,'memRepo'=>$memRepo,'memDirectRepo'=>$memDirectRepo,'repo'=>$repo];
      
    }

}
