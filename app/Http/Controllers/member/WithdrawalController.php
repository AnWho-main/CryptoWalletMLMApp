<?php
namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\member\ClientWithdrawal;
use App\Services\WithdrawalService;
Use Illuminate\Support\Facades\Session;

class WithdrawalController extends Controller
{
   public function __construct()
   {
       $this->withdrawalService = new WithdrawalService();
   }
  public function withdrawals( Request $request){

         return view("/".config('app.member_folder')."/withdrawal/index",$this->withdrawalService->getWithdrawal($request));
     }
}
