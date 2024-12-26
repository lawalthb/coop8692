<?php
$currentBalance = 0;
$newAmount = 0;
function generateReference($prefix = '')
{
    return $prefix . time() . rand(1000, 9999);
}

return $currentBalance + $newAmount;
function calculateBalance($transactions)
{
    $currentBalance = 0; // Initialize balance

    foreach ($transactions as $transaction) {
        $currentBalance += $transaction->credit_amount - $transaction->debit_amount;
    }

    return $currentBalance;
}

function calculateNewBalance($userId, $amount) {
    $lastTransaction = \App\Models\Transaction::where('user_id', $userId)
        ->latest()
        ->first();

    $currentBalance = $lastTransaction ? $lastTransaction->balance : 0;
    return $currentBalance + $amount;
}
