<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artifact extends Model
{
    use HasFactory;

    protected $table = 'artifacts';

    protected $fillable = [
        'name',
        'description',
        'period',
        'material',
        'location',
        'created_by',
        'type',
        'priority',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'artifacts_categories');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function filestorageable()
    {
        return $this->morphMany(FileStorage::class, 'filestorageable');
    }
}

