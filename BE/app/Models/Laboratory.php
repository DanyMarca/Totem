<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;

    protected $table = 'laboratories';

    protected $fillable = [
        'category_id',
        'name',
        'description',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'Laboratories_Categories', 'laboratory_id', 'category_id');
    }

    public function filestorageable()
    {
        return $this->morphMany(Filestorage::class, 'filestorageable');
    }
}
