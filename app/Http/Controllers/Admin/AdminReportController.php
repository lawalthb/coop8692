<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Saving;
use App\Models\Loan;
use App\Models\SavingType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\MembersExport;
use App\Exports\LoansExport;


class AdminReportController extends Controller
{
    public function index()
    {
        $stats = [
            'total_members' => User::where('is_admin', false)->count(),
            'active_members' => User::where('is_admin', false)->where('is_approved', 1)->count(),
            'total_savings' => Saving::sum('amount'),
            'active_loans' => Loan::where('status', 'active')->count(),
            'loan_amount' => Loan::where('status', 'active')->sum('amount'),
            'total_transactions' => Transaction::count(),
        ];

        return view('admin.reports.index', compact('stats'));
    }

    public function members(Request $request)
    {
        $query = User::where('is_admin', false)
            ->when($request->status, function ($q) use ($request) {
                return $q->where('is_approved', $request->status === 1);
            })
            ->when($request->date_from, function ($q) use ($request) {
                return $q->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($q) use ($request) {
                return $q->whereDate('created_at', '<=', $request->date_to);
            });
        $members = $query->latest()->paginate(15);

        return view('admin.reports.members', compact('members'));
    }

    public function savings(Request $request)
    {
        $query = Saving::with(['user', 'savingType'])
            ->when($request->member_id, function ($q) use ($request) {
                return $q->where('user_id', $request->member_id);
            })
            ->when($request->saving_type_id, function ($q) use ($request) {
                return $q->where('saving_type_id', $request->saving_type_id);
            })
            ->when($request->date_from, function ($q) use ($request) {
                return $q->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($q) use ($request) {
                return $q->whereDate('created_at', '<=', $request->date_to);
            });

        $savings = $query->latest()->paginate(15);
        $members = User::where('is_admin', false)->get();
        $savingTypes = SavingType::where('status', 'active')->get();

        return view('admin.reports.savings', compact('savings', 'members', 'savingTypes'));
    }

    public function loans(Request $request)
    {
        $query = Loan::with(['user', 'loanType'])
            ->when($request->status, function ($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->when($request->member_id, function ($q) use ($request) {
                return $q->where('user_id', $request->member_id);
            })
            ->when($request->date_from, function ($q) use ($request) {
                return $q->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($q) use ($request) {
                return $q->whereDate('created_at', '<=', $request->date_to);
            });

        $loans = $query->latest()->paginate(15);
        $members = User::where('is_admin', false)->get();

        return view('admin.reports.loans', compact('loans', 'members'));
    }

    public function transactions(Request $request)
    {
        $query = Transaction::with('user')
            ->when($request->type, function ($q) use ($request) {
                return $q->where('type', $request->type);
            })
            ->when($request->member_id, function ($q) use ($request) {
                return $q->where('user_id', $request->member_id);
            })
            ->when($request->date_from, function ($q) use ($request) {
                return $q->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($q) use ($request) {
                return $q->whereDate('created_at', '<=', $request->date_to);
            });

        $transactions = $query->latest()->paginate(15);
        return view('admin.reports.transactions', compact('transactions'));
    }

    public function exportMembers(Request $request)
    {
        $query = User::where('is_admin', false)
            ->when($request->status, function ($q) use ($request) {
                return $q->where('is_active', $request->status === 'active');
            })
            ->when($request->date_from, function ($q) use ($request) {
                return $q->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($q) use ($request) {
                return $q->whereDate('created_at', '<=', $request->date_to);
            });

        if ($request->format === 'pdf') {
            $members = $query->get();
            $pdf = PDF::loadView('admin.reports.members-pdf', compact('members'));
            return $pdf->download('members-report.pdf');
        }

        return Excel::download(new MembersExport($query), 'members-report.xlsx');
    }


    public function exportLoans(Request $request)
    {
        $query = Loan::with(['user', 'loanType'])
            ->when($request->status, function ($q) use ($request) {
                return $q->where('status', $request->status);
            })
            ->when($request->member_id, function ($q) use ($request) {
                return $q->where('user_id', $request->member_id);
            })
            ->when($request->date_from, function ($q) use ($request) {
                return $q->whereDate('created_at', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($q) use ($request) {
                return $q->whereDate('created_at', '<=', $request->date_to);
            });

        if ($request->format === 'pdf') {
            $loans = $query->get();
            $pdf = PDF::loadView('admin.reports.loans-pdf', compact('loans'));
            return $pdf->download('loans-report.pdf');
        }

        return Excel::download(new LoansExport($query), 'loans-report.xlsx');
    }
}
