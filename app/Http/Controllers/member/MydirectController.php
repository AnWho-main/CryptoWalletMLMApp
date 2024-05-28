<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\MyDirectService;

class MydirectController extends Controller
{
    public function __construct()
    {
        $this->myDirectService = new MyDirectService();
    }

    public function myDirect(Request $request)
    {
        return view("/" . config('app.member_folder') . "/myDirect/index", $this->myDirectService->myDirect($request));
    }
}
