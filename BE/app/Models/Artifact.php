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
        return $this->belongsToMany(Category::class, 'artifact_categories', 'artifact_id', 'category_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function photos()
    {
        return $this->morphMany(FileStorage::class, 'photosAble');
    }
}

