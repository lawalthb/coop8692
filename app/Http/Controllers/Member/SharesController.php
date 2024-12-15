<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class SharesController extends Controller
{
    public function index()
    {
        $data = [
            'total_shares' => auth()->user()->transactions()
                ->where('type', 'shares')
                ->sum('credit_amount'),

            'transactions' => auth()->user()->transactions()
                ->where('type', 'shares')
                ->latest()
                ->paginate(10)
        ];

        return view('member.shares.index', compact('data'));
    }
}
