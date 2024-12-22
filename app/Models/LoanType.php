<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    protected $fillable = [
        'name',
        'required_active_savings_months',
        'savings_multiplier',
        'interest_rate',

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
        return $this->attributes['interest_rate'];
    }
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
