<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string $surname
 * @property string $firstname
 * @property string|null $othername
 * @property string|null $gender
 * @property string|null $facebook
 * @property string|null $home_address
 * @property string $phone_number
 * @property string $email
 * @property string|null $dob
 * @property string|null $nationality
 * @property int $state_id
 * @property int $lga_id
 * @property string|null $nok
 * @property string|null $nok_relationship
 * @property string|null $nok_address
 * @property string|null $marital_status
 * @property string|null $hostel_name
 * @property string|null $occupation
 * @property string|null $religion
 * @property string|null $nok_phone
 * @property string|null $monthly_savings
 * @property string|null $share_subscription
 * @property string|null $month_commence
 * @property string|null $signature_image
 * @property string|null $date_join
 * @property string|null $admin_remark
 * @property string $admin_sign
 * @property string|null $admin_signdate
 * @property string $member_no
 * @property string|null $gensec_sign_image
 * @property string|null $president_sign
 * @property string|null $member_image
 * @property mixed $password
 * @property int $is_admin
 * @property int $is_approved
 * @property string|null $approved_at
 * @property int|null $approved_by
 * @property string|null $remember_token
 * @property int $membership_declaration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoanGuarantor> $guarantorRequests
 * @property-read int|null $guarantor_requests_count
 * @property-read \App\Models\Lga $lga
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Loan> $loans
 * @property-read int|null $loans_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ProfileUpdateRequest> $profileUpdateRequests
 * @property-read int|null $profile_update_requests_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Saving> $savings
 * @property-read int|null $savings_count
 * @property-read \App\Models\State $state
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Transaction> $transactions
 * @property-read int|null $transactions_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdminRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdminSign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAdminSigndate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApprovedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApprovedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDateJoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereGensecSignImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHomeAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereHostelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLgaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMemberImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMemberNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMembershipDeclaration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMonthCommence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMonthlySavings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNokAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNokPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNokRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereOthername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePresidentSign($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereReligion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereShareSubscription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSignatureImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'surname',
        'firstname',
        'othername',
        'gender',
        'facebook',
        'home_address',
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
        'share_subscription',
        'month_commence',
        'signature_image',
        'date_join',
        'member_no',
        'password',
        'is_admin',
        'is_approved',
        'hostel_name',
        'occupation',
    ];
    protected $appends = ['full_name'];
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

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function lga()
    {
        return $this->belongsTo(Lga::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->title} {$this->surname} {$this->firstname} {$this->othername}";
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function savings()
    {
        return $this->hasMany(Saving::class);
    }

    public function guarantorRequests()
    {
        return $this->hasMany(LoanGuarantor::class, 'user_id');
    }

    public function getTotalSavings()
    {
        return Transaction::where('user_id', $this->id)
            ->where('type', 'savings')
            ->sum('credit_amount');
    }

    public function getSavingsDurationInMonths()
    {
        $firstSaving = Transaction::where('user_id', $this->id)
            ->where('type', 'savings')
            ->orderBy('created_at', 'asc')
            ->first();

        if (!$firstSaving) {
            return 0;
        }

        return $firstSaving->created_at->diffInMonths(now());
    }

    public function profileUpdateRequests()
    {
        return $this->hasMany(ProfileUpdateRequest::class);
    }
    }

