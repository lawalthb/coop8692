<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
