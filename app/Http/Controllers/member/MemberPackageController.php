<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
Use Session;
use App\Services\PackageService;

class MemberPackageController extends Controller
{
      public function __construct()
      {
          $this->PackageService = new PackageService();
      }

     public function buypackage($type){
      return view("/".config('app.member_folder')."/packages/edit", $this->PackageService->ShowPackData($type));  
     }

    public function buypack(Request $request){
      return $this->PackageService->Buypackage($request);
    }
    
    public function buyboost(Request $request){
      return $this->PackageService->BuyBoosting($request);        
    }
}

