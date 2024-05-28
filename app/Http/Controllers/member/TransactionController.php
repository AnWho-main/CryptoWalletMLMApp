<?php

namespace App\Http\Controllers\member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->transactionService = new TransactionService();
    }

    public function index(Request $request){
        return view('member.transaction.index',$this->transactionService->getAllTransaction($request));
    }
}
