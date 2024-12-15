<?php

function generateReference($prefix = '')
{
    return $prefix . time() . rand(1000, 9999);
}

    return $currentBalance + $newAmount;
function calculateNewBalance($userId, $newAmount)
{
    $lastTransaction = \App\Models\Transaction::where('user_id', $userId)
        ->latest()
        ->first();

    if (!$lastTransaction) {
        return $newAmount;
    }

    $currentBalance = $lastTransaction->balance;
    return $currentBalance + $newAmount;
}

