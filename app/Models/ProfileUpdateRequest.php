<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $title
 * @property string|null $surname
 * @property string|null $firstname
 * @property string|null $othername
 * @property string|null $home_address
 * @property string|null $gender
 * @property string|null $phone_number
 * @property string|null $email
 * @property \Illuminate\Support\Carbon|null $dob
 * @property string|null $nationality
 * @property int|null $state_id
 * @property int|null $lga_id
 * @property string|null $nok
 * @property string|null $nok_relationship
 * @property string|null $nok_address
 * @property string|null $marital_status
 * @property string|null $hostel_name
 * @property string|null $occupation
 * @property string|null $religion
 * @property string|null $nok_phone
 * @property string|null $monthly_savings
 * @property string|null $signature_image
 * @property string|null $member_image
 * @property string $status
 * @property string|null $admin_remarks
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Lga|null $lga
 * @property-read \App\Models\State|null $state
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereAdminRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereHomeAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereHostelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereLgaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereMaritalStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereMemberImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereMonthlySavings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereNok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereNokAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereNokPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereNokRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereOthername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereReligion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereSignatureImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProfileUpdateRequest whereUserId($value)
 * @mixin \Eloquent
 */
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
        'admin_remarks',
        'hostel_name',
        'occupation',
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
