<?php

namespace App\Services\support;

use App\Http\Controllers\Api\V1\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\member\MemberProfile;
use App\Models\member\ClientProfile;
use App\Models\member\ClientTransactions;
use App\Models\member\MasterCountry;
use App\Models\member\MasterProductCategory;
use App\Models\member\SupportSection;
use App\Models\member\SupportTicket;
use Log;
use Exception;

use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use SebastianBergmann\Type\TrueType;

class MticketService
{
    public function __construct()
    {
        $this->status                           = 'status';
        $this->message                          = 'message';
        $this->code                             = 'status_code';
        $this->data                             = 'data';
    }

    public function index($request)
    {
        $ses = Session::get('loginID');

        $pagArray = config('global.pagingListArray');
        if ($request->input('per_page_selected') != "") {
            $per_page_selected = $request->input('per_page_selected');
        } else {
            $per_page_selected = $pagArray[0];
        }

        $whereCondition = [];
        if (!empty($request->input('ticket_username'))) {
            $whereCondition[] = ['ticket_username', 'LIKE', $request->input('ticket_username') . '%'];
        }
        if (!empty($request->input('ticket_no'))) {
            $whereCondition[] = ['ticket_no', 'LIKE', $request->input('ticket_no') . '%'];
        }
        if (!empty($request->input('ticket_status'))) {
            if ($request->input('ticket_status') == -1) {
                $whereCondition[] = ['ticket_status', '=', 0];
            } else {
                $whereCondition[] = ['ticket_status', '=', $request->input('ticket_status')];
            }
        }

        if (!empty($request->input('ticket_section'))) {

            $whereCondition[] = ['ticket_section', '=', $request->input('ticket_section')];
        }

        $data = SupportTicket::where($whereCondition)
            ->where('parent', 0)
            ->where('replied_by_username', $ses)
            ->orderBy('id', 'DESC')
            ->paginate($per_page_selected);

        $sections = SupportSection::all();

        $support = [];
        if (count($data) > 0) {
            foreach ($data as $rs) {
                $supp = SupportSection::where('id', $rs->ticket_section)->first();
                $support[] = $supp->section_name;
            }
        }

        return view("/" . config('app.member_folder') . "/support/listTicket", ['rsd' => $data, 'sections' => $sections, 'support' => $support]);
    }
    public function insert($request)
    {
        $ticket_username = Session::get('loginID');

        $ticket_no = $request->input('ticket_no');
        $ticket_subject = $request->input('ticket_subject');
        $ticket_status = $request->input('ticket_status');
        $ticket_message = $request->input('ticket_message');
        $ticket_section = $request->input('ticket_section');
        $date = date('Y-m-d h:i:s');
        $imageName_qr = $request->file('ticket_attachment');

        try {
            \DB::beginTransaction();
            $idi =  ClientProfile::where('client_id', $ticket_username)->first();

            if (!isset($idi)) {
                \DB::rollBack();
                return redirect(route('member-show-ticket'))->with('alt', 'Invalid Username');
            }


            do {
                $randomNumber = random_int(10000000, 99999999);
            } while (SupportTicket::where("ticket_no", "=", $randomNumber)->first());
            // $randomNumber = random_int(10000000, 99999999);

            if (is_null($imageName_qr)) {
                $id = SupportTicket::create([
                    'ticket_username' => $ticket_username,
                    'ticket_no' => $randomNumber,
                    'replied_by' => 'user',
                    'ticket_subject' => $ticket_subject,
                    'replied_by_username' => $ticket_username,
                    'user_type' => 'admin',
                    'ticket_status' => $ticket_status,
                    'ticket_message' => $ticket_message,
                    'ticket_section' => $ticket_section,
                    'created_at' => $date,
                ])->id;
                if (!isset($id)) {
                    \DB::rollBack();
                    return redirect(route('member-show-ticket'))->with('alt', 'insertion failed');
                }
            } else {
                $set_img_path_qr = time() . $imageName_qr->getClientOriginalName();
                $imageName_qr->move(public_path('upload\useruploads'), $set_img_path_qr);
                $foo = \File::extension($set_img_path_qr);

                if ($foo == 'jpg' || $foo == 'png' || $foo == 'jpeg') {
                    $id = SupportTicket::create([
                        'ticket_username' => $ticket_username,
                        'ticket_no' => $randomNumber,
                        'ticket_subject' => $ticket_subject,
                        'replied_by_username' => $ticket_username,
                        'ticket_status' => $ticket_status,
                        'ticket_message' => $ticket_message,
                        'ticket_section' => $ticket_section,
                        'replied_by' => 'user',
                        'user_type' => 'admin',
                        'ticket_attachment' => $set_img_path_qr,
                        'created_at' => $date,
                    ])->id;
                    if (!isset($id)) {
                        \DB::rollBack();
                        return redirect(route('member-show-ticket'))->with('alt', 'Insertion failed');
                    }
                }
            }
            \DB::commit();
            return redirect(route('member-show-ticket'))->with('status', 'Record Inserted Successfully');
        } catch (Exception $e) {
            \DB::rollBack();
            $except['status']           = false;
            $except['error'][]          = 'Exception Error...';
            $except['message']          = $e;
            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($except, 500);
        }
    }

    public function updateTicket($id, $request)
    {

        $ticket_username =  $ses = Session::get('loginID');

        $ticket_subject = $request->input('ticket_subject');
        $ticket_status = $request->input('ticket_status');
        $ticket_message = $request->input('ticket_message');
        $ticket_section = $request->input('ticket_section');
        $date1 = date('Y-m-d h:i:s');
        $imageName_qr = $request->file('ticket_attachment');

        try {
            \DB::beginTransaction();
            if (!is_null($imageName_qr)) {

                $set_img_path_qr = time() . $imageName_qr->getClientOriginalName();
                $imageName_qr->move(public_path('upload\useruploads'), $set_img_path_qr);
                $foo = \File::extension($set_img_path_qr);


                $foo = \File::extension($set_img_path_qr);
                if ($foo == 'jpg' || $foo == 'png' || $foo == 'jpeg') {

                    $data = array(
                        "ticket_username" => $ticket_username, 'ticket_subject' => $ticket_subject,
                        'ticket_status' => $ticket_status, 'ticket_message' => $ticket_message, 'ticket_section' => $ticket_section, "ticket_attachment" => $set_img_path_qr, "updated_at" => $date1
                    );

                    $update = SupportTicket::where('id', $id)->update($data);
                    if (!$update) {
                        \DB::rollBack();
                        return response()->json(['error' => 'Failed to update record'], 500);
                    }
                    \DB::commit();
                    return redirect(route('edit-ticket', ['id' => $id]))->with('status', 'Record Updated Successfully');
                } else {
                    \DB::rollBack();
                    return redirect(route('edit-ticket', ['id' => $id, 'btn' => 'Update']));
                }
            } else if (!is_null($ticket_username) &&  is_null($imageName_qr)) {

                $data = array(
                    "ticket_username" => $ticket_username, 'ticket_subject' => $ticket_subject,
                    'ticket_status' => $ticket_status, 'ticket_message' => $ticket_message, 'ticket_section' => $ticket_section, "updated_at" => $date1
                );

                $update = SupportTicket::where('id', $id)->update($data);
                if (!$update) {
                    \DB::rollBack();
                    return response()->json(['error' => 'Failed to update record'], 500);
                }
                \DB::commit();
                return redirect(route('member-edit-ticket', ['id' => $id]))->with('status', 'Record Updated Successfully');
            }
        } catch (Exception $e) {
            \DB::rollBack();
            $except['status']           = false;
            $except['error'][]          = 'Exception Error...';
            $except['message']          = $e;
            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($except, 500);
        }
    }

    public function showChat($id)
    {
        $data = SupportTicket::where('id', $id)->first();

        //   $seemsg = SupportTicket::where('id', $id)
        //   ->orWhere('parent',$id)
        //   ->update(['ticket_viewed'=>1]);

        $section = SupportSection::where('id', $data->ticket_section)->first();

        $rid = $data->id;
        $dta =  SupportTicket::where(function ($q) use ($rid) {
            $q->where('id', $rid)
                ->orWhere('parent', $rid);
        })->get();

        $userData =  MemberProfile::where('client_id', $data->replied_by_username)->first();

        return view("/" . config('app.member_folder') . "/support/chatTicket", ['rsd' => $data, 'section' => $section, 'data' => $dta, 'userData' => $userData]);
    }

    public function updateChat($request)
    {
        try {
            \DB::beginTransaction();
            $sts = $request->input('ticket_status');
            $id = $request->input('ticket_id');

            $update = SupportTicket::where('id', $id)
                ->update(['ticket_status' => $sts]);
            if (!$update) {
                \DB::rollBack();
                return response()->json(['error' => 'Failed to update record'], 500);
            }
            \DB::commit();
            return response('Update Successfully.', 200);
        } catch (Exception $e) {
            \DB::rollBack();
            $except['status']           = false;
            $except['error'][]          = 'Exception Error...';
            $except['message']          = $e;
            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($except, 500);
        }
    }

    public function updateStatus($id)
    {
        try {
            \DB::beginTransaction();
            $data = SupportTicket::where('id', $id)->first();

            if ($data->ticket_status == 0) {
                $val = 1;
            } else {
                $val = 0;
            }
            $update = SupportTicket::where('id', $id)
                ->update(['ticket_status' => $val]);
            if (!$update) {
                \DB::rollBack();
                return response()->json(['error' => 'Failed to update record'], 500);
            }
            \DB::commit();
            return response()->json(['success' => 'Record has beed updated']);
        } catch (Exception $e) {
            \DB::rollBack();
            $except['status']           = false;
            $except['error'][]          = 'Exception Error...';
            $except['message']          = $e;
            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($except, 500);
        }
    }

    public function update($request)
    {
        try {
            \DB::beginTransaction();
            $posts = MasterProductCategory::all();
            $t = 0;
            foreach ($posts as $post) {
                foreach ($request->input('order') as $order) {
                    if ($order['id'] == $post->cat_id) {
                        //   $post->update(['order' => $order['position']]);
                        $t = $order['id'];
                        $update = MasterProductCategory::where('cat_id', $order['id'])
                            ->update(['sequence_no' => $order['position']]);
                        if (!$update) {
                            \DB::rollBack();
                            return response()->json(['error' => 'Failed to update record'], 500);
                        }
                    }
                }
            }
            \DB::commit();
            return response('Update Successfully.', 200);
        } catch (Exception $e) {
            \DB::rollBack();
            $except['status']           = false;
            $except['error'][]          = 'Exception Error...';
            $except['message']          = $e;
            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($except, 500);
        }
    }

    public function sendMemberMsg($id, $request)
    {

        $validated = $request->validate([
            'amsg' => 'required',
        ]);

        $ses = Session::get('loginID');

        $msg = $request->input('amsg');
        $date = date('Y-m-d h:i:s');
        $imageName_qr = $request->file('myfile');
        try {
            \DB::beginTransaction();
            $presentData =  SupportTicket::where('id', $id)
                ->first();
            //   $database->get("support_ticket", '*', ["id" => $uid]);

            $value =  [
                'ticket_message' => $msg, 'parent' => $id, 'replied_by' => 'user',
                'ticket_username' => $presentData->ticket_username, 'ticket_section' => $presentData->ticket_section, 'user_type' => 'user', 'ticket_viewed' => 0,
                'replied_by_username' => $ses, 'ticket_no' => $presentData->ticket_no, 'created_at' => $date
            ];

            if (!empty($imageName_qr)) {

                $set_img_path_qr = time() . $imageName_qr->getClientOriginalName();
                $imageName_qr->move(public_path(config('global.UPLOADPATH')), $set_img_path_qr);

                $foo = \File::extension($set_img_path_qr);
                if ($foo == 'jpg' || $foo == 'png' || $foo == 'jpeg') {
                    $value =  array_merge($value, ['ticket_attachment' => $set_img_path_qr]);
                }
            }
            $store = SupportTicket::insert($value);
            if (!$store) {
                \DB::rollBack();
                return response()->json(['error' => 'Failed to insert record'], 500);
            }
            \DB::commit();
            return redirect(route('member-show-ticketchat', ['id' => $id]))->with('status', 'Record Updated Successfully');
        } catch (Exception $e) {
            \DB::rollBack();
            $except['status']           = false;
            $except['error'][]          = 'Exception Error...';
            $except['message']          = $e;
            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($except, 500);
        }
    }

    public function deleteData($id)
    {
        try {
            \DB::beginTransaction();
            $data = SupportTicket::destroy($id);

            $subdata = SupportTicket::where('parent', $id)->delete();
            // if ($subdata) {
            //     \DB::commit();
            //     return redirect(route('member-search-listTicket'))
            //         ->with('status', 'Record Deleted Successfully');
            // } else {
            //     \DB::rollBack();
            //     return response()->json(['error' => 'Failed to delete record'], 500);
            // }
            \DB::commit();
            return redirect(route('member-search-listTicket'))
                ->with('status', 'Record Deleted Successfully');
        } catch (Exception $e) {
            \DB::rollBack();
            $except['status']           = false;
            $except['error'][]          = 'Exception Error...';
            $except['message']          = $e;
            $exception                  = new BaseController();
            $exception                  = $exception->throwExceptionError($except, 500);
        }
    }
}
