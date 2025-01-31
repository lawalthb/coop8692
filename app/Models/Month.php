<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Month newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Month newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Month query()
 * @method static \Illuminate\Database\Eloquent\Builder|Month whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Month whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Month whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Month whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Month extends Model
{
    protected $fillable = [
        'name'
    ];
}
