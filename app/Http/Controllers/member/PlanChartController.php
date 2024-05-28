<?php
namespace App\Http\Controllers\member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use Session;

class PlanChartController extends Controller
{ 
    public function planChart(Request $request){        
         return view("/".config('app.member_folder')."/business/plan");
     }
}
