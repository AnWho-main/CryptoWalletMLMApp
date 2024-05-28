<?php

namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\member\MemberProfile;
use Illuminate\Support\Facades\Validator;
Use Session;
use App\Services\KYCService;

class UpdateKYCController extends Controller
{
   public function __construct()
   {
       $this->KYCService = new KYCService();
   }
   

  public function editKYC(){
    return view("/".config('app.member_folder')."/kyc/edit", $this->KYCService->ShowKYCData());  
   }

  public function updateKYC(Request $request){
    return $this->KYCService->UpdateKYCData($request);   
   }
  
     
}
