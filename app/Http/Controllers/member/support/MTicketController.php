<?php

namespace App\Http\Controllers\member\support;
// use Illuminate\Support\Facades\DB;
use App\Models\member\ClientProfile;
use App\Models\member\SupportTicket;
use App\Models\member\SupportSection;
use App\Models\member\MemberProfile;
use App\Http\Controllers\Controller;
use App\Services\support\MticketService;
use Illuminate\Http\Request;
use Session;



class MTicketController extends Controller
{
   public function __construct()
   {
      $this->ticketService = new MticketService();
   }
   public function show()
   {
      $btn = "Add";
      return view('member.support.ticket', ["btn" => $btn]);
   }

   public function insert(Request $request)
   {
      return  $this->ticketService->insert($request);
   }

   public function showData(Request $request)
   {
      return $this->ticketService->index($request);
   }

   public function deleteData($id)
   {
      return $this->ticketService->deleteData($id);
   }

   public function editticket($id)
   {

      $data = SupportTicket::where('id', $id)->first();

      $btn = "Update";

      return view('member.support.ticket', ['upd' => $data, "btn" => $btn]);
   }

   public function updateticket($id, Request $request)
   {
      return $this->ticketService->updateTicket($id, $request);
   }

   public function updateStatus($id)
   {
      return $this->ticketService->updateStatus($id);
   }

   public function showchat($id)
   {
      return $this->ticketService->showChat($id);
   }

   public function updateChat(Request $request)
   {
      return $this->ticketService->updateChat($request);
   }

   public function update(Request $request)
   {
      return $this->ticketService->update($request);
   }

   public function sendmembermsg($id, Request $request)
   {
      return $this->ticketService->sendMemberMsg($id, $request);
   }
}
