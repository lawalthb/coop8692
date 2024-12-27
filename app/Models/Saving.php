<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
