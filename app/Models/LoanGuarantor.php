<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $loan_id
 * @property int $user_id
 * @property string $status
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $responded_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Loan $loan
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor whereLoanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor whereRespondedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoanGuarantor whereUserId($value)
 * @mixin \Eloquent
 */
class LoanGuarantor extends Model
{
    protected $fillable = [
        'loan_id',
        'user_id',
        'status',
        'comment',
        'responded_at'
    ];

    protected $casts = [
        'responded_at' => 'datetime'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
