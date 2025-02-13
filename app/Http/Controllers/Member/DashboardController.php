<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $data = [
            'total_savings' => $user->savings()->where('saving_type_id', 1)->sum('amount'),
            'total_shares' => $user->transactions()->where('type', 'shares')->sum('credit_amount'),
            'active_loans' => $user->loans()->where('status', 'approved')->get(),
            'recent_transactions' => $user->transactions()->latest()->take(5)->get(),
            'pending_guarantor_requests' => $user->guarantorRequests()->where('status', 'pending')->count(),
            'unread_notifications' => $user->unreadNotifications->count()
        ];

        return view('member.dashboard', compact('data'));
    }
}
