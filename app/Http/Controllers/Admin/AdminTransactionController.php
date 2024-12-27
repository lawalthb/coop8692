<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTransactionController extends Controller
{
public function index(Request $request)
{
    $query = Transaction::with(['user']);

    if ($request->filled('start_date')) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }

    if ($request->filled('end_date')) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    if ($request->filled('member_id')) {
        $query->where('user_id', $request->member_id);
    }

    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    $transactions = $query->latest()->paginate(15);
    $members = User::where('is_admin', false)->get();
    $transactionTypes = Transaction::distinct()->pluck('type');

    return view('admin.transactions.index', compact('transactions', 'members', 'transactionTypes'));
}
    

}
