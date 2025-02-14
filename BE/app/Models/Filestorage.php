<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filestorage extends Model
{
    use HasFactory;

    protected $table = 'filestorages';

    protected $fillable = [
        'path',
        'caption',
        'created_at',
        'filestorageable_id',
        'filestorageable_type',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->path ? asset('storage/' . $this->path) : null;
    }

    public function filestorageable()
    {
        return $this->morphTo();
    }
}
