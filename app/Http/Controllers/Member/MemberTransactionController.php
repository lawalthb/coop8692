<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MemberTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::where('user_id', auth()->id());

        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $transactions = $query->latest()->get();

        // Calculate running balance
        $runningBalance = 0;
        foreach ($transactions as $transaction) {
            $runningBalance += ($transaction->credit_amount - $transaction->debit_amount);
            $transaction->running_balance = $runningBalance;
        }

        return view('member.transactions.index', compact('transactions', 'runningBalance'));
    }
    
}
