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
}
