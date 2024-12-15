<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title', 'surname', 'firstname', 'othername', 'gender',
        'facebook', 'home_address', 'phone_number', 'email',
        'dob', 'nationality', 'state_id', 'lga_id',
        'nok', 'nok_relationship', 'nok_address', 'marital_status',
        'religion', 'nok_phone', 'monthly_savings', 'share_subscription',
        'month_commence', 'signature_image', 'date_join', 'member_no',
        'password', 'is_admin', 'is_approved'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
