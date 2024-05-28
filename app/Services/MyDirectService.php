<?php

namespace App\Services;

use App\Models\member\ClientProfile;
use Illuminate\Support\Facades\Session;


class MyDirectService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
    }

  
    public function myDirect($request){
        $pagArray = config('global.pagingListArray');
        if($request->input('per_page_selected')!=""){
        $per_page_selected = $request->input('per_page_selected');
        }else{
        $per_page_selected = $pagArray[0];
        }
  
        $whereCondition = [];
        if(!empty($request->input('client_id'))){
           $whereCondition[] = ['client_profile_accounts.client_id', 'LIKE', $request->input('client_id').'%'];
        }
        if(!empty($request->input('datefrom'))){
           $whereCondition[] = ['client_profile_accounts.join_date', '>=', $request->input('datefrom')];
        }
        if(!empty($request->input('dateto'))){
           $whereCondition[] = ['client_profile_accounts.join_date', '<=', $request->input('dateto')];
        }
  
        $client_id = Session::get('loginID');
        $data = ClientProfile::join('client_profile_personals', 'client_profile_accounts.client_id', '=', 'client_profile_personals.client_id')
        ->where($whereCondition)
        ->where('client_intro_id','=', $client_id)
        ->orderBy('client_profile_accounts.join_date','DESC')
        ->paginate($per_page_selected);
     
        return ['rsd' => $data];
  
    }
}
