<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $transaction_id
 * @property string $status
 * @property string $description
 * @property string|null $admin_response
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Transaction $transaction
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute whereAdminResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionDispute whereUserId($value)
 * @mixin \Eloquent
 */
class TransactionDispute extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'status',
        'description',
        'admin_response'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
