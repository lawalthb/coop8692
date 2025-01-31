<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $state_id
 * @property string $name
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\State $state
 * @method static \Illuminate\Database\Eloquent\Builder|Lga newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lga newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Lga query()
 * @method static \Illuminate\Database\Eloquent\Builder|Lga whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lga whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lga whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lga whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lga whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Lga whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Lga extends Model
{
    protected $fillable = [
        'state_id',
        'name',
        'status'
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
