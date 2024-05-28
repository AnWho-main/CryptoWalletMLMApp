<?php

namespace App\Services;
use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\member\MemberProfile;
use App\Models\member\ClientProfile;
use App\Models\member\MasterCountry;
use Log;
use Exception;

Use Session;
use Carbon\Carbon;

class ProfileService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
    }

    public function ShowProfileData()
    {
        $sa=Session::get('loginID');
        $data = MemberProfile::where('client_id',$sa)->first();
        $dataAccount = ClientProfile::where('client_id',$sa)->first('wallet_address');
        $master_countries = MasterCountry::where('id',$data->m_country)->first();
        
       return ['rsd' => $data,'mcon' => $master_countries,'client_account' => $dataAccount];
    }

    public function EditProfileData(){
        $sa=Session::get('loginID');
        $data = MemberProfile::where('client_id', $sa)->first();
        $btn = "Update";
        $master_countries = MasterCountry::all();

        return ['upd'=>$data,"btn"=>$btn,"mcon" => $master_countries];
    }

   public function UpdateProfileData(Request $request){
    $sa1=Session::get('loginID');
    $m_name = $request->input('m_name');
    $m_father_name = $request->input('m_father_name');
    $m_email = $request->input('m_email');
    $m_mobile = $request->input('m_mobile'); 
    $m_dob = $request->input('m_dob');
    $m_address = $request->input('m_address');
    $m_city = $request->input('m_city');
    $m_state = $request->input('m_state');
    $m_country = $request->input('m_country');
    $m_pin = $request->input('m_pin');
    $date = date('Y-m-d h:i:s');
 
     $imageName_qr= $request->file('photo');

      if(!is_null($imageName_qr) ){
      
             $set_img_path_qr = time().$imageName_qr->getClientOriginalName();
             // public_path(
             $imageName_qr->move(config('app.folder_upload'), $set_img_path_qr);
             $foo = \File::extension($set_img_path_qr);
         
             if($foo == 'jpg' || $foo == 'png' || $foo == 'jpeg'){

                try {
                    \DB::beginTransaction();

                $data=array('m_father_name'=>$m_father_name,'m_dob'=>$m_dob ,'m_address'=>$m_address ,
                'm_city'=>$m_city , 'm_state'=>$m_state ,'m_email'=>$m_email,'m_mobile'=>$m_mobile,
                'm_country'=>$m_country, 'm_pin'=>$m_pin,'m_name'=>$m_name,
                "m_photo"=>$set_img_path_qr, "created_at"=>$date);
                
                MemberProfile::where('client_id', $sa1)->update($data);
                
                \DB::commit();

                 /*
                 Send email here for update profile
                 */

                   return back()->with('updt', 'Record updated successfully!');
                } catch (Exception $e) {
                    \DB::rollBack();
                    $except['status']           = false;
                    $except['error'][]          = 'Exception Error...';
                    $except['message']          = $e;
                    $exception                  = new BaseController();
                    $exception                  = $exception->throwExceptionError($except, 500);
                }

             }else{
                return back()->with('nupdt', 'Please upload a valid image!');;
                }

             }
             else if(is_null($imageName_qr)){  
                try {
                    \DB::beginTransaction();

             $data=array('m_father_name'=>$m_father_name,'m_dob'=>$m_dob ,'m_address'=>$m_address ,
             'm_city'=>$m_city,'m_state'=>$m_state ,'m_name'=>$m_name,'m_email'=>$m_email,'m_mobile'=>$m_mobile, 
             'm_country'=>$m_country, 'm_pin'=>$m_pin, "updated_at"=>$date);
             
             MemberProfile::where('client_id', $sa1)->update($data);

             \DB::commit();

            } catch (Exception $e) {
                \DB::rollBack();
                $except['status']           = false;
                $except['error'][]          = 'Exception Error...';
                $except['message']          = $e;
                $exception                  = new BaseController();
                $exception                  = $exception->throwExceptionError($except, 500);
            }
            } 
             return back()->with('updt', 'Record updated successfully!');
       }

}