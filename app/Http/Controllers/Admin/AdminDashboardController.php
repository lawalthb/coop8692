<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Loan;
use App\Models\Saving;
use App\Models\Transaction;
use App\Models\Year;

class AdminDashboardController extends Controller
{
public function index()
{
    $currentYear = now()->year;
    $months = collect(range(1, 12))->map(function($month) use ($currentYear) {
        $date = \Carbon\Carbon::createFromDate($currentYear, $month, 1);
            return [
                'name' => $date->format('M'),
                'savings' => Saving::whereYear('saving_date', $currentYear)
                                ->whereMonth('saving_date', $month)
                                ->sum('amount'),
                'loans' => Loan::whereYear('created_at', $currentYear)
                                ->whereMonth('created_at', $month)
                                ->sum('amount')
            ];


    });

    $chartData = [
        'labels' => $months->pluck('name'),
        'savings' => $months->pluck('savings'),
        'loans' => $months->pluck('loans')
    ];

    $data = [
        'total_members' => User::where('is_admin', false)->count(),
        'active_loans' => Loan::where('status', 'active')->count(),
        'total_savings' => Transaction::where('type', 'savings')->sum('credit_amount'),
        'recent_members' => User::where('is_admin', false)->latest()->take(5)->get(),
        'recent_loans' => Loan::with('user')->latest()->take(5)->get(),
        'recent_savings' => Saving::with('user')->latest()->take(5)->get(),
    ];

    return view('admin.dashboard', compact('data', 'chartData'));
}

}
