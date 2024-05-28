<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\member\MemberProfile;
use App\Models\member\MasterCommission;
use App\Models\member\ClientProfile;
use App\Services\DownlineListService;
use Session;

class DownLineListController extends Controller
{

   public function __construct()
   {
      $this->downlineListService = new DownlineListService();
   }
   public function downlineList(Request $request)
   {
      return  $this->downlineListService->getdownlineList($request);
   }
}
