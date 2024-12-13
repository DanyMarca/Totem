<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];

    public function artifacts()
    {
        return $this->belongsToMany(Artifact::class, 'artifact_categories', 'category_id', 'artifact_id');
    }

    public function laboratories()
    {
        return $this->hasMany(Laboratory::class, 'category_id');
    }
}
