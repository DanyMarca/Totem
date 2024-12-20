<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'caption_intro', 'caption_specific', 'color'];

    public function artifacts()
    {
        return $this->belongsToMany(Artifact::class, 'artifact_categories');
    }

    public function laboratories()
    {
        return $this->hasMany(Laboratory::class, 'category_id');
    }

    public function filestorageable()
    {
        return $this->morphMany(FileStorage::class, 'filestorageable');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
}
