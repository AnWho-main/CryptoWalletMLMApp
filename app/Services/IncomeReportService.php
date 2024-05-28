<?php

namespace App\Services;

use App\Models\member\ClientPayout;
use App\Models\member\ClientProfile;
use Illuminate\Support\Facades\Session;


class IncomeReportService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
    }


  public function IncomeReports($request,$income){
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
      $whereCondition[] = ['client_payouts.payout_date', '>=', $request->input('datefrom')];
   }
   if(!empty($request->input('dateto'))){
      $whereCondition[] = ['client_payouts.payout_date', '<=', $request->input('dateto')];
   }
   if(!empty($request->input('ref_name'))){
      $whereCondition[] = ['client_profile_personals.m_name', 'LIKE', $request->input('ref_name').'%'];
   }
   if(!empty($request->input('client_intro_id'))){
         $whereCondition[] = ['client_profile_accounts.client_intro_id', 'LIKE', $request->input('client_intro_id').'%'];
   }

   $ses = Session::get('loginID');

   $data = ClientPayout::join('client_profile_accounts', 'client_payouts.user_id', '=', 'client_profile_accounts.id')
   ->leftjoin('client_profile_personals', 'client_payouts.ref_user_id', '=', 'client_profile_personals.id')
   ->select('client_payouts.*',
   'client_profile_accounts.client_id as client_id',
   'client_profile_personals.m_name as m_name',
   'client_profile_personals.client_id as rclient_id')
   ->where('client_profile_accounts.client_id', $ses)
   ->where('income_type', $income)
   ->where($whereCondition)
   ->orderBy('client_payouts.id', 'DESC')
   ->paginate($per_page_selected);

    return view("/".config('app.member_folder')."/IncomeReports/index",['rsd' => $data,'st'=>$income]);
  }
}
