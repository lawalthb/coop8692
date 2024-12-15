<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Loan;
use App\Models\Transaction;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_members' => User::where('is_admin', false)->count(),
            'pending_members' => User::where('is_approved', false)->count(),
            'active_loans' => Loan::where('status', 'active')->count(),
            'pending_loans' => Loan::where('status', 'pending')->count(),
            'total_savings' => Transaction::where('type', 'savings')->sum('credit_amount'),
            'total_loans' => Loan::where('status', 'active')->sum('amount'),
        ];

        return view('admin.dashboard', compact('data'));
    }
}
