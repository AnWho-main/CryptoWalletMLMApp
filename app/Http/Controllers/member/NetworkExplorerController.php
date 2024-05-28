<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\member\ClubStartup;
use App\Models\member\ClubSilver;
use App\Models\member\ClientProfile;
use App\Models\member\MemberProfile;
use App\Services\NetworkExplorerService;
use Illuminate\Support\Facades\DB;
use Session;



class NetworkExplorerController extends Controller
{

   public function __construct()
   {
       $this->NetworkExplorerService = new NetworkExplorerService();
   }
   public function networkExplore(Request $request)
   {
      return $this->NetworkExplorerService->NetworkExplorer($request);
   }
}
