<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminExpenseController extends Controller
{
    public function create()
    {
        return view('admin.expenses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
            'reference' => 'nullable|string|unique:transactions,reference'
        ]);

        Transaction::create([
            'user_id' => 1,
            'type' => 'expense',
            'debit_amount' => $request->amount,
            'reference' => $request->reference ?? 'EXP' . Str::random(8),
            'description' => $request->description,
            'posted_by' => auth()->id(),
            'transaction_date' => $request->transaction_date
        ]);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Expense recorded successfully');
    }
}
