<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $loan_id
 * @property string $reference
 * @property string $amount
 * @property \Illuminate\Support\Carbon $payment_date
 * @property string $payment_method
 * @property string $status
 * @property string|null $notes
 * @property int $posted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Loan $loan
 * @property-read \App\Models\User $postedBy
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment whereLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment wherePostedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanRepayment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class LoanRepayment extends Model
{
    protected $fillable = [
        'loan_id',
        'reference',
        'amount',
        'payment_date',
        'payment_method',
        'status',
        'notes',
        'posted_by'
    ];

    protected $casts = [
        'payment_date' => 'date'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
