<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->path ? asset( $this->path) : null;
    }

    public function filestorageable()
    {
        return $this->morphTo();
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($file) {
            info("Tentativo di eliminare il file: " . $file->image_url);
            // Elimina il file dal disco se esiste
            if ($file->image_url) {
                Storage::delete($file->image_url);
            }
        });
    }
}
