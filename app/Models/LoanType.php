<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $required_active_savings_months
 * @property string $savings_multiplier
 * @property string $interest_rate
 * @property int $max_duration_months
 * @property string $minimum_amount
 * @property string $maximum_amount
 * @property bool $allow_early_payment
 * @property string $saved_percentage
 * @property int $no_guarantors
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Loan> $loans
 * @property-read int|null $loans_count
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType active()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereAllowEarlyPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereInterestRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereMaxDurationMonths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereMaximumAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereMinimumAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereNoGuarantors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereRequiredActiveSavingsMonths($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereSavedPercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereSavingsMultiplier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
