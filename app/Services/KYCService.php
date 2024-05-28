<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\member\MemberProfile;
use App\Models\member\ClientProfile;
use App\Models\member\MasterCountry;
use Log;
use Exception;

Use Session;
use Carbon\Carbon;

class KYCService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
    }

    public function ShowKYCData()
    {
        $sa=Session::get('loginID');
        $data = MemberProfile::where('client_id', $sa)->first();

        $vc = 0;
        if($data->kyc_status == "approved" || $data->kyc_status == "pending"){
        $vc = 1;
        }
    return ['upd'=>$data,'vc'=>$vc];
    }

    public function UpdateKYCData(Request $request){

        $request -> validate([
            'pan_image' => 'required|max:512', // 1 MB in kilobytes
            'adhaar_image' => 'required|max:512',
        ]);
            
         $sa1=Session::get('loginID');
         // $m_name = $request->input('m_name');
         $m_pan = $request->input('m_pan');
         // $m_email = $request->input('m_email');
         // $m_mobile = $request->input('m_mobile');
         $m_adhar_no = $request->input('m_adhar_no');
      
         $imageName_pan = $request->file('pan_image');
         $imageName_aadhar = $request->file('adhaar_image');
      
         // echo MemberProfile::where('client_id',$sa1)->whereNull('kyc_status')->first();
         // die();
      
         // $chk = MemberProfile::where('client_id',$sa1)->whereNULL('kyc_status')->get();
         // if(!$chk->isEmpty()){

            // if(!MemberProfile::where('m_mobile', $m_mobile)->where('client_id','!=',$sa1)->get()->isEmpty()){
            //    return back()->with('nupdt', 'Mobile number already exist!');
            // }  
            // if(!MemberProfile::where('m_email', $m_email)->where('client_id','!=',$sa1)->get()->isEmpty()){
            //    return back()->with('nupdt', 'Email already exist!');
            // }  
            if(!MemberProfile::where('m_pan', $m_pan)->where('client_id','!=',$sa1)->get()->isEmpty()){
               return back()->with('nupdt', 'PAN number already exist!');
            }  
            if(!MemberProfile::where('m_adhar_no', $m_adhar_no)->where('client_id','!=',$sa1)->get()->isEmpty()){
               return back()->with('nupdt', 'Aadhar number already exist!');
            }  
         // }
      
           
            $date = date('Y-m-d h:i:s');
      
            $value =  ['m_pan' => $m_pan,'m_adhar_no' => $m_adhar_no,'kyc_status'=> "pending",'updated_at' => $date];
      
            if(!empty($imageName_pan)){     
      //		kyc_path
                  $set_img_path_pan = time().$imageName_pan->getClientOriginalName();
                  $imageName_pan->move( config('app.kyc_path')."/PAN/", $set_img_path_pan);
         
                  $foo = \File::extension($set_img_path_pan);
                  if($foo == 'jpg' || $foo == 'png' || $foo == 'jpeg'){
                     $value =  array_merge($value, ['pan_image' => $set_img_path_pan]);
                  }else{
                     return back()->with('nupdt', 'Please upload valid PAN image!');
                  }
            }
      
            if(!empty($imageName_aadhar)){     
               $set_img_path_aadhar = time().$imageName_aadhar->getClientOriginalName();
               $imageName_aadhar->move( config('app.kyc_path')."/AADHAR/", $set_img_path_aadhar );
      
               $foo = \File::extension($set_img_path_aadhar );
               if($foo == 'jpg' || $foo == 'png' || $foo == 'jpeg'){
                  $value =  array_merge($value, ['adhaar_image' => $set_img_path_aadhar ]);
               }else{
                  return back()->with('nupdt', 'Please upload valid aadhar image!');
               }
          }
      
               $pro_id = MemberProfile::where('client_id', $sa1)->update($value);

               return back()->with('updt', 'Record updated successfully!');

    }   

}