<?php
namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\member\MemberProfile;
use App\Models\member\ClientProfile;
Use Session;

class WelcomeController extends Controller
{
  public function welcome( Request $request){
        $sa=Session::get('loginID');

         $data = MemberProfile::where('client_id',$sa)->first();

         $client_acc = ClientProfile::where('client_id', Session::get('loginID'))->first();

         return view("/".config('app.member_folder')."/business/welcome",['rsd' => $data,'client_acc' => $client_acc]);
     }
}
