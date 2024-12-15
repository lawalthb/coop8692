<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use PDF;

class StatementController extends Controller
{
    public function index(Request $request)
    {
        $transactions = auth()->user()->transactions()
            ->when($request->type, function($query, $type) {
                return $query->where('type', $type);
            })
            ->when($request->date_from, function($query, $date) {
                return $query->whereDate('transaction_date', '>=', $date);
            })
            ->when($request->date_to, function($query, $date) {
                return $query->whereDate('transaction_date', '<=', $date);
            })
            ->latest()
            ->paginate(15);

        return view('member.statements.index', compact('transactions'));
    }

    public function download(Request $request)
    {
        $transactions = auth()->user()->transactions()
            ->when($request->type, function($query, $type) {
                return $query->where('type', $type);
            })
            ->when($request->date_from, function($query, $date) {
                return $query->whereDate('transaction_date', '>=', $date);
            })
            ->when($request->date_to, function($query, $date) {
                return $query->whereDate('transaction_date', '<=', $date);
            })
            ->latest()
            ->get();

        $pdf = PDF::loadView('member.statements.pdf', compact('transactions'));

        return $pdf->download('statement.pdf');
    }
}
