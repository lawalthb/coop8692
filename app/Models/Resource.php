<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string $file_path
 * @property string $file_type
 * @property string $file_size
 * @property int $uploaded_by
 * @property int $download_count
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $uploadedBy
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource query()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereDownloadCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereFileSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereFileType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource whereUploadedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Resource withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Resource withoutTrashed()
 * @mixin \Eloquent
 */
class Resource extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_type',
        'file_size',
        'uploaded_by',
        'download_count',
        'status'
    ];

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function incrementDownloadCount()
    {
        $this->increment('download_count');
    }
}
