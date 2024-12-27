<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProfileUpdateRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'surname',
        'firstname',
        'othername',
        'home_address',
        'gender',
        'phone_number',
        'email',
        'dob',
        'nationality',
        'state_id',
        'lga_id',
        'nok',
        'nok_relationship',
        'nok_address',
        'marital_status',
        'religion',
        'nok_phone',
        'monthly_savings',
        'signature_image',
        'member_image',
        'status',
        'admin_remarks'
    ];

    protected $casts = [
        'dob' => 'date',
        'monthly_savings' => 'decimal:2'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }


}
