<?php

namespace App\Services;

use App\Models\member\ClientProfile;
use Illuminate\Support\Facades\Session;


class NetworkExplorerService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
    }


    public function NetworkExplorer($request){
        if(!empty($request->input('client_id'))){
            $cid = $request->input('client_id');
   
            $sid = ClientProfile::where('client_id',$cid)->first();
   
            $lid = Session::get('loginID');
            $uid = ClientProfile::where('client_id',$lid)->first(); 
   
            if($uid > $sid){
               return back()->with('pdenied','Searching permission denied!!');
            }
         }else{
            $cid = Session::get('loginID');
         }
         
         if(!empty($request->input('club'))){
            $clb  = $request->input('club');
            $cl = 'App\\Models\\member\\'.$clb;
         }else{
             $clb = "ClientProfile";
             $cl = "App\Models\member\ClientProfile";
         }
   
         $ids = $cl::where('client_id',$cid)
         ->first();

         
         if(empty($ids)){
               return view("/".config('app.member_folder')."/networkExplorer/index");
         }
   
         $id =  $cid; 

     
         $sid = ClientProfile::where('client_id',$cid)->first();
   
         if(!empty($sid)){
            $name= $sid->m_name;
         }else{
            $name= 'XYZ ';
         }
   
         $data = array('uid'=>$id,'clb'=>$clb,'cid'=>$cid,'name'=>$name); 
         
         
         return view("/" . config('app.member_folder') . "/networkExplorer/index", ['rsd' => $data]);
         
    }
}
