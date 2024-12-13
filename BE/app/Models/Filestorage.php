<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileStorage extends Model
{
    use HasFactory;

    protected $table = 'filestorages';

    protected $fillable = [
        'file_url',
        'caption',
        'created_at',
        'photos_able_id',
        'photos_able_type',
    ];

    public function photosAble()
    {
        return $this->morphTo();
    }
}
