<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $data = [
            'total_savings' => $user->transactions()
                ->where('type', 'savings')
                ->sum('credit_amount'),

            'total_shares' => $user->transactions()
                ->where('type', 'shares')
                ->sum('credit_amount'),

            'active_loans' => $user->loans()
                ->where('status', 'active')
                ->get(),

            'recent_transactions' => $user->transactions()
                ->latest()
                ->take(5)
                ->get(),
        ];

        return view('member.dashboard', compact('data'));
    }
}
