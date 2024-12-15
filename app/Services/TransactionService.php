<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Str;

class TransactionService
{
    public function createSavingTransaction($userId, $savingTypeId, $amount, $transactionDate)
    {
        $previousBalance = Transaction::where('user_id', $userId)
            ->latest('id')
            ->value('balance') ?? 0;

        return Transaction::create([
            'user_id' => $userId,
            'type' => 'savings',
            'saving_type_id' => $savingTypeId,
            'credit_amount' => $amount,
            'debit_amount' => 0,
            'balance' => $previousBalance + $amount,
            'reference' => 'SAV' . Str::random(8),
            'description' => 'Saving deposit',
            'posted_by' => auth()->id(),
            'transaction_date' => $transactionDate,
            'status' => 'completed'
        ]);
    }

    public function createLoanTransaction($userId, $loanId, $amount, $transactionDate, $type = 'disbursement')
    {
        $previousBalance = Transaction::where('user_id', $userId)
            ->latest('id')
            ->value('balance') ?? 0;

        $isRepayment = $type === 'repayment';

        return Transaction::create([
            'user_id' => $userId,
            'type' => 'loan_' . $type,
            'loan_id' => $loanId,
            'debit_amount' => $isRepayment ? 0 : $amount,
            'credit_amount' => $isRepayment ? $amount : 0,
            'balance' => $previousBalance + ($isRepayment ? $amount : -$amount),
            'reference' => ($isRepayment ? 'LNR' : 'LND') . Str::random(8),
            'description' => 'Loan ' . $type,
            'posted_by' => auth()->id(),
            'transaction_date' => $transactionDate,
            'status' => 'completed'
        ]);
    }
}
