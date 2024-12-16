<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanType;
use App\Http\Requests\LoanApplicationRequest;
use Illuminate\Support\Str;

class MemberLoansController extends Controller
{
    public function index()
    {
        $data = [
            'active_loans' => auth()->user()->loans()
                ->whereIn('status', ['active', 'pending'])
                ->latest()
                ->get(),
            'loan_history' => auth()->user()->loans()
                ->whereIn('status', ['completed', 'rejected'])
                ->latest()
                ->get(),
            'loan_types' => LoanType::where('status', 'active')->get()
        ];
        $loans = Loan::where('user_id', auth()->id())->latest()->get();
        $loanTypes = LoanType::where('status', 'active')->get();
        return view('member.loans.index', compact('data', 'loans', 'loanTypes'));
    }

    public function create()
    {
        $loanTypes = LoanType::where('status', 'active')->get();
        return view('member.loans.create', compact('loanTypes'));
    }

    public function store(LoanApplicationRequest $request)
    {
        $loan = Loan::create([
            'user_id' => auth()->id(),
            'loan_type_id' => $request->loan_type_id,
            'reference' => 'LOAN' . Str::random(8),
            'amount' => $request->amount,
            'duration' => $request->duration,
            'purpose' => $request->purpose,
            'status' => 'pending',
            'posted_by' => auth()->id()
        ]);

        return redirect()->route('member.loans.index')
            ->with('success', 'Loan application submitted successfully');
    }
}
