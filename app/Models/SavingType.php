<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingType extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'interest_rate',
        'minimum_balance',
        'is_mandatory',
        'allow_withdrawal',
        'withdrawal_restriction_days',
        'status'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
