<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileStorage extends Model
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

    public function filestorageable()
    {
        return $this->morphTo();
    }
}
