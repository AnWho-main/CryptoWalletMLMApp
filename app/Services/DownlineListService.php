<?php

namespace App\Services;

use App\Models\member\ClientProfile;
use App\Models\member\MasterCommission;
use Illuminate\Support\Facades\Session;
use App\Services\HelperService;

class DownlineListService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';

        $this->helperService = new HelperService();
    }

  
    public function getDownlineList($request){
        $pagArray = config('global.pagingListArray');
        if($request->input('per_page_selected')!=""){
        $per_page_selected = $request->input('per_page_selected');
        }else{
        $per_page_selected = $pagArray[0];
        }
  
        $whereCondition = [];
        if(!empty($request->input('datefrom'))){
           $whereCondition[] = ['client_profile_accounts.join_date', '>=', $request->input('datefrom')];
        }
        if(!empty($request->input('dateto'))){
           $whereCondition[] = ['client_profile_accounts.join_date', '<=', $request->input('dateto')];
        }
        if(!empty($request->input('status'))){
           $sts = 1;
           if($request->input('status') == 2)
            $sts= 0;
           $whereCondition[] = ['client_profile_accounts.activation_status',$sts];
        }
  
        if(!empty($request->input('level'))){
          $ll = $request->input('level');
        }else{
           $ll = 1;
        }
  
        if(!empty($request->input('client_id'))){
           $ses= $request->input('client_id'); 
           
           $sid = ClientProfile::where('client_id',$ses)->first();
  
           $lid = Session::get('loginID');
           $uid = ClientProfile::where('client_id',$lid)->first(); 
  
           if($uid > $sid){
              return back()->with('pdenied','Searching permission denied!!');
           }
           }else{
              $ses = Session::get('loginID');
          }
  
        $tabName = "ClientProfile";
        $colClient = "client_id";
        $colParent = "parent_id";
        $uid = array($ses);
        $levelLimit = $ll;
        
        $childNodes = $this->helperService->getNthLevelChilds($tabName,$colClient,$colParent,$levelLimit, $uid);

       //  $childNodes = \AppHelper::instance()->getNthLevelChildsLimited($tabName,$colClient,$colParent,$levelLimit, $uid);
      
        $trimmed = trim($childNodes,"'");
        $childArray= explode("','",$trimmed);
  
        $query = ClientProfile::select('client_profile_accounts.id', 'client_profile_accounts.client_id', 'client_profile_accounts.join_date', 'client_profile_accounts.activation_date', 'client_profile_accounts.activation_time', 'client_profile_accounts.activation_status', 'client_profile_accounts.blocked_status', 'client_profile_personals.m_name', 'client_profile_personals.m_city')
        ->leftJoin('client_profile_personals', 'client_profile_accounts.id', '=', 'client_profile_personals.id')
        ->whereIn('client_profile_accounts.client_id', $childArray)
        ->where($whereCondition)
        ->orderBy('client_profile_accounts.join_date', 'ASC')
        ->orderBy('client_profile_accounts.id', 'ASC')
        ->paginate($per_page_selected);
  
        $level= MasterCommission::all();
  
        return view("/" . config('app.member_folder') . "/downlineList/index",['rsd' => $query,'level' => $level]);
    }
}
