<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', '1_year', '2_year', '3_year', '4_year', '5_year'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
