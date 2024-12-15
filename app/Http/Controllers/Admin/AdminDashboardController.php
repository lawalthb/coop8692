<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Loan;
use App\Models\Saving;
use App\Models\Transaction;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_members' => User::where('is_admin', false)->count(),
            'active_loans' => Loan::where('status', 'active')->count(),
            'total_savings' => Transaction::where('type', 'savings')->sum('credit_amount'),
            'recent_members' => User::where('is_admin', false)->latest()->take(5)->get(),
            'recent_loans' => Loan::with('user')->latest()->take(5)->get(),
            'recent_savings' => Saving::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('data'));
    }
}
