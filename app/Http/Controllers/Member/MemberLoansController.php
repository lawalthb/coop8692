<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanType;
use App\Http\Requests\LoanApplicationRequest;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\LoanGuarantor;
use App\Notifications\GuarantorRequestNotification;
use Illuminate\Support\Facades\Notification;

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
        $members = User::where('id', '!=', auth()->user()->id)->get();
        return view('member.loans.create', compact('loanTypes', 'members'));
    }

    public function store(LoanApplicationRequest $request)
    {
        $loanType = LoanType::findOrFail($request->loan_type_id);

        // Calculate loan details
        $interestRate = $request->duration;

        $interestAmount = ($request->amount * $interestRate / 100);
        $totalAmount = $request->amount + $interestAmount;
        $monthlyPayment = $totalAmount / $request->duration;

        $loan = Loan::create([
            'user_id' => auth()->id(),
            'loan_type_id' => $request->loan_type_id,
            'reference' => 'LOAN' . Str::random(8),
            'amount' => $request->amount,
            'interest_amount' => $interestAmount,
            'total_amount' => $totalAmount,
            'monthly_payment' => $monthlyPayment,
            'duration' => $request->duration,
            'purpose' => $request->purpose,
            'start_date' => now(),
            'end_date' => now()->addMonths($request->duration),
            'status' => 'pending',
            'posted_by' => auth()->id()
        ]);

        if ($request->has('guarantors')) {
            foreach ($request->guarantors as $guarantorId) {
                // Create guarantor record
                $guarantor = LoanGuarantor::create([
                    'loan_id' => $loan->id,
                    'user_id' => $guarantorId,
                    'status' => 'pending',
                    'responded_at' => null
                ]);

                $guarantorUser = User::find($guarantorId);
                $guarantorUser->notify(new GuarantorRequestNotification($loan));
            }
            return redirect()->route('member.loans.index')
                ->with('success', 'Loan application submitted successfully and guarantors have been notified');
        }
    }


    public function show(Loan $loan)
    {
        dd(1);
        $loan->load(['loanType', 'guarantors']);
        return view('member.loans.show', compact('loan'));
    }
}
