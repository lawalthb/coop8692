<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property string|null $description
 * @property string $interest_rate
 * @property string $minimum_balance
 * @property int $is_mandatory
 * @property int $allow_withdrawal
 * @property int $withdrawal_restriction_days
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType query()
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereAllowWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereInterestRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereIsMandatory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereMinimumBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SavingType whereWithdrawalRestrictionDays($value)
 * @mixin \Eloquent
 */
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
