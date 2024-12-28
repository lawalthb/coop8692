<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminGrantController extends Controller
{
    public function create()
    {
        return view('admin.grants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',

            'reference' => 'nullable|string|unique:transactions,reference'
        ]);

        Transaction::create([
            'user_id' => 1,
            'type' => 'grant',
            'credit_amount' => $request->amount,
            'reference' => $request->reference ?? 'GRT' . Str::random(8),
            'description' => $request->description ?? 'Grant',

            'posted_by' => auth()->id(),
            'transaction_date' => $request->transaction_date
        ]);

        return redirect()->route('admin.transactions.index')
            ->with('success', 'Grant entry recorded successfully');
    }
}
