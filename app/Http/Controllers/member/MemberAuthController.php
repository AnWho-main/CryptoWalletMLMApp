<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\member\LoginModel;
use App\Models\member\ClientProfile;
use App\Models\member\MemberProfile;
use Hash;
use Session;

class MemberAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLoginForm()
    {
        return view('member.auth.login');
    }

    /**
     * submit login form.
     */
    public function autologin(Request $request){
        $request -> validate([
          'address' =>'required',
      ]);
      
       $user = LoginModel::where('wallet_address', '=', $request->address)->first();
       
        if(isset($user)){
            
              $request->session()->put('loginID', $user->client_id);
              $request->session()->put('userID', $user->id);
              $request->session()->put('loginAddress', $user->wallet_address);
              return redirect("/".config('app.member_folder')."/dashboard");
            
        }else{
            return back()->with('denied','Address not found');
            
        }
      
   }

    public function memberlogout()
    {
        if(Session::has('loginID')){
            Session::pull('loginID');
	    //            return redirect("/".config('app.member_folder')."/login");
	    return redirect()->route('member-signin');            
        }
    }

    public function registerform($upline){ 
        return view("/".config('app.member_folder')."/auth"."/registration",['upline' => $upline]);
    }
    
      public function registerformopen(){
        return view("/".config('app.member_folder')."/auth"."/registration");
    }

    public function register(Request $request){
        $request -> validate([
            'upline' =>'required',
            'address' =>'required'
        ]);

       $upline =  strtoupper($request->upline);
       $address =  $request->address;

     $adrrcheck =  ClientProfile::where('wallet_address', $address)
       ->where('blocked_status', 0)
       ->first();

       $uplinecheck =  ClientProfile::where('client_id', $upline)
       ->where('blocked_status', 0)
       ->where('activation_status', 1)
       ->first();

        if($uplinecheck){
            if(!$adrrcheck){
               
                $jdate = date('Y-m-d');
                $date = date('Y-m-d h:i:s');
                
                   do {
                $cid = 'ITES';
                $characters = array_merge(range('0','9'));
                
                for ($i = 0; $i < 6; $i++) {
                    $rand = mt_rand(0, count($characters)-1);
                    $cid .= $characters[$rand];
                }
                $client_max_id = $cid;
           } while ( ClientProfile::where('client_id', $client_max_id)->exists() );

                $trans_password=str_shuffle(substr("123456789123456789123456789123456789123456789123456789123456789",1,8));

                $ClientProfile = new ClientProfile();
                $ClientProfile->client_id = $client_max_id;
                $ClientProfile->client_intro_id = $upline;
                $ClientProfile->parent_id = $upline;
                $ClientProfile->join_date = $jdate;
                $ClientProfile->wallet_address = $address;
                $ClientProfile->created_at = $date;
                $ClientProfile->save();

                $lastID = $ClientProfile->id;

                $mobile_key = mt_rand(100000,999999);

                for ($randomNumber = mt_rand(1, 9), $i = 1; $i < 25; $i++) 
                      {
                          $randomNumber .= mt_rand(0, 9);
                      }
      
                    $email_key                  = base64_encode($randomNumber); // Encrypted Activation code
                    $param = [];
                    $param['email_key']         = $email_key;
                    $param['mobile_key']         = $mobile_key;

                $MemberProfile = new MemberProfile();
                $MemberProfile->id = $lastID;
                $MemberProfile->client_id = $client_max_id;
                $MemberProfile->created_at = $date;
                $MemberProfile->email_key = $email_key;
                $MemberProfile->mobile_key = $mobile_key; 
                $MemberProfile->save();

                return back()->with('success', 'Registration successfully done!');
            }else{
                return back()->with('fail', 'Address is already exist!');
            }  
        }else{
            return back()->with('fail', 'Upline not found or Inactive');
        }

    }

}
