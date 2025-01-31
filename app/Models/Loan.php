<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $loan_type_id
 * @property string $reference
 * @property string $amount
 * @property string $interest_amount
 * @property string $total_amount
 * @property string $monthly_payment
 * @property string $paid_amount
 * @property int $duration
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property string $status
 * @property string $purpose
 * @property string|null $rejection_reason
 * @property int|null $approved_by
 * @property \Illuminate\Support\Carbon|null $approved_at
 * @property int $posted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User|null $approvedBy
 * @property-read mixed $remaining_amount
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanGuarantor> $guarantors
 * @property-read int|null $guarantors_count
 * @property-read \App\Models\LoanType $loanType
 * @property-read \App\Models\User $postedBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanRepayment> $repayments
 * @property-read int|null $repayments_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereInterestAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereLoanTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereMonthlyPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan wherePaidAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan wherePostedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan wherePurpose($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereRejectionReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Loan withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Loan withoutTrashed()
 * @mixin \Eloquent
 */
class Loan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'loan_type_id',
        'reference',
        'amount',
        'interest_amount',
        'total_amount',
        'monthly_payment',
        'paid_amount',
        'duration',
        'start_date',
        'end_date',
        'status',
        'purpose',
        'rejection_reason',
        'approved_by',
        'approved_at',
        'posted_by'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loanType()
    {
        return $this->belongsTo(LoanType::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function guarantors()
    {
        return $this->hasMany(LoanGuarantor::class);
    }

    public function repayments()
    {
        return $this->hasMany(LoanRepayment::class);
    }

    public function getRemainingAmountAttribute()
    {
        return $this->total_amount - $this->paid_amount;
    }
}
