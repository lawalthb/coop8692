<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\SavingType;
use App\Models\Transaction;

class SavingsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $data = [
            'saving_types' => SavingType::where('status', 'active')->get(),
            'total_savings' => $user->transactions()
                ->where('type', 'savings')
                ->sum('credit_amount'),
            'transactions' => $user->transactions()
                ->where('type', 'savings')
                ->latest()
                ->paginate(10),
        ];

        return view('member.savings.index', compact('data'));
    }
}
