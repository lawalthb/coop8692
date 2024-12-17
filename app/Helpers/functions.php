<?php

function generateReference($prefix = '')
{
    return $prefix . time() . rand(1000, 9999);
}

    return $currentBalance + $newAmount;
function calculateBalance($transactions) {
    $currentBalance = 0; // Initialize balance

    foreach ($transactions as $transaction) {
        $currentBalance += $transaction->credit_amount - $transaction->debit_amount;
    }

    return $currentBalance;
}
