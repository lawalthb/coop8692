<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
}
