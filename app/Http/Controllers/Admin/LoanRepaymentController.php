<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanRepayment;
use App\Http\Requests\LoanRepaymentRequest;
use App\Notifications\LoanRepaymentNotification;
use App\Services\TransactionService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LoanRepaymentController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function create(Loan $loan)
    {
        return view('admin.loan-repayments.create', compact('loan'));
    }

    public function store(LoanRepaymentRequest $request, Loan $loan)
    {
        DB::transaction(function () use ($request, $loan) {
            $repayment = LoanRepayment::create([
                'loan_id' => $loan->id,
                'reference' => 'REP' . Str::random(8),
                'amount' => $request->amount,
                'payment_date' => $request->payment_date,
                'payment_method' => $request->payment_method,
                'notes' => $request->notes,
                'posted_by' => auth()->id()
            ]);

            $this->transactionService->createLoanTransaction(
                $loan->user_id,
                $loan->id,
                $request->amount,
                $request->payment_date,
                'repayment'
            );

            $loan->increment('paid_amount', $request->amount);

            if ($loan->paid_amount >= $loan->total_amount) {
                $loan->update(['status' => 'completed']);
            }


            $ReturnSavingsAmount =  ($loan->amount / $loan->duration);
            // Create savings record
            DB::table('savings')->insert([
                'user_id' => $loan->user_id,
                'amount' => $ReturnSavingsAmount,
                'saving_type_id' => 1,
                'reference' => 'LOA' . Str::random(10),
                'month_id' => now()->month,
                'year_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
                'saving_date' => now(),
                'posted_by' => auth()->id()
            ]);
            // Notify loan owner
            $loan->user->notify(new LoanRepaymentNotification($loan, $repayment));

        });



        return redirect()->route('admin.loans.show', $loan)
            ->with('success', 'Loan repayment recorded successfully');
    }
}
