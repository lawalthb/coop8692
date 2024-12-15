<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    protected $fillable = [
        'name',
        'required_active_savings_months',
        'savings_multiplier',
        'interest_rate_12_months',
        'interest_rate_18_months',
        'max_duration_months',
        'minimum_amount',
        'maximum_amount',
        'allow_early_payment',
        'saved_percentage',
        'no_guarantors',
        'status'
    ];

    protected $casts = [
        'allow_early_payment' => 'boolean'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function getInterestRateAttribute()
    {
        return $this->interest_rate_12_months;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
