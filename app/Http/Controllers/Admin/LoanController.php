<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\User;
use App\Models\LoanType;
use App\Http\Requests\LoanApprovalRequest;
use App\Services\TransactionService;
use App\Notifications\LoanStatusNotification;
use Illuminate\Support\Facades\DB;
use App\Models\LoanRepayment;
use App\Notifications\LoanRepaymentNotification;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;


class LoanController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index()
    {
        $loans = Loan::with(['user', 'loanType'])
            ->latest()
            ->paginate(15);
        return view('admin.loans.index', compact('loans'));
    }

    public function show(Loan $loan)
    {
        $loan->load(['user', 'loanType', 'guarantors.user', 'repayments']);
        return view('admin.loans.show', compact('loan'));
    }

    public function approve(LoanApprovalRequest $request, Loan $loan)
    {
        DB::transaction(function () use ($loan, $request) {
            $loan->update([
                'status' => 'approved',
                'approved_by' => auth()->id(),
                'approved_at' => now(),
            ]);

            $this->transactionService->createLoanTransaction(
                $loan->user_id,
                $loan->id,
                $loan->amount,
                now(),
                'disbursement'
            );

            $loan->user->notify(new LoanStatusNotification($loan, 'approved'));
        });

        return redirect()->route('admin.loans.show', $loan)
            ->with('success', 'Loan has been approved successfully');
    }

    public function reject(LoanApprovalRequest $request, Loan $loan)
    {
        $loan->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        $loan->user->notify(new LoanStatusNotification($loan, 'rejected'));

        return redirect()->route('admin.loans.show', $loan)
            ->with('success', 'Loan has been rejected');
    }


    public function recordRepayment(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'payment_method' => 'required|string',

        ]);

        DB::transaction(
            function () use ($loan, $validated) {
                $repayment = LoanRepayment::create([
                    'loan_id' => $loan->id,
                    'amount' => $validated['amount'],
                    'payment_date' => $validated['payment_date'],
                    'payment_method' => $validated['payment_method'],
                    'reference_number' => 'LOANREP' . Str::random(10),
                    'posted_by' => auth()->id(),
                    'status' => 'confirmed'
                ]);



                // Create transaction record
                $this->transactionService->createLoanTransaction(
                    $loan->user_id,
                    $loan->id,
                    $validated['amount'],
                    $validated['payment_date'],
                    'repayment'
                );

        // Update loan paid amount
        $loan->update([
            'paid_amount' => $loan->paid_amount + $validated['amount']
        ]);

        // Notify loan owner
        $loan->user->notify(new LoanRepaymentNotification($loan, $repayment));
    });
        return redirect()->back()->with('success', 'Loan repayment recorded successfully');
    }
}

