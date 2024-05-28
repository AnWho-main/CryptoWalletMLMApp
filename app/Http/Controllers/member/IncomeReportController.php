<?php

namespace App\Http\Controllers\Member;
use App\Models\member\ClientPayout;
use App\Models\member\ClientProfile;
use App\Models\member\MemberProfile;
use App\Http\Controllers\Controller;
use App\Services\IncomeReportService;
use Illuminate\Http\Request;
Use Illuminate\Support\Facades\Session;

class IncomeReportController extends Controller
{
   public function __construct()
   {
      $this->incomeListService = new IncomeReportService();
   }
   public function showIncomeData(Request $request,$income){
     
       return $this->incomeListService->IncomeReports($request,$income);

   }

}