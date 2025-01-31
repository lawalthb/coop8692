<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $transactionable_id
 * @property string $transactionable_type
 * @property string $type
 * @property string $debit_amount
 * @property string $credit_amount
 * @property string $balance
 * @property string $reference
 * @property string $description
 * @property int $posted_by
 * @property \Illuminate\Support\Carbon $transaction_date
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\TransactionDispute|null $dispute
 * @property-read \App\Models\User $postedBy
 * @property-read \App\Models\SavingType|null $savingType
 * @property-read Model|\Eloquent $transactionable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreditAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDebitAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction wherePostedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereReference($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction withoutTrashed()
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'transactionable_id',
        'transactionable_type',
        'type',
        'debit_amount',
        'credit_amount',
        'balance',
        'reference',
        'description',
        'posted_by',
        'transaction_date',
        'status',

    ];

    protected $casts = [
        'transaction_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savingType()
    {
        return $this->belongsTo(SavingType::class);
    }

    public function postedBy()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function transactionable()
    {
        return $this->morphTo();
    }


public function dispute()
{
    return $this->hasOne(TransactionDispute::class);
}
}
