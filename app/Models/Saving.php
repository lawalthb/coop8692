<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $saving_type_id
 * @property string $amount
 * @property int $month_id
 * @property int $year_id
 * @property string $reference
 * @property string $status
 * @property string|null $remark
 * @property string $saving_date
 * @property int $posted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $postedBy
 * @property-read \App\Models\SavingType $savingType
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Saving newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Saving newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Saving query()
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereMonthId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving wherePostedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereSavingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereSavingTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Saving whereYearId($value)
 * @mixin \Eloquent
 */
class Saving extends Model
{
    protected $fillable = [
        'user_id',
        'saving_type_id',
        'amount',
        'reference',
        'status',
        'posted_by',
        'month_id',
        'year_id',
        'saving_date' 
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function savingType(): BelongsTo
    {
        return $this->belongsTo(SavingType::class);
    }

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }




public function transactions()
{
    return $this->morphMany(Transaction::class, 'transactionable');
}
}
