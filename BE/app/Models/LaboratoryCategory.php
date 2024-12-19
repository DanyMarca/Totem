<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryCategory extends Model
{
    use HasFactory;

    protected $table = 'laboratories_categories';

    protected $fillable = [
        'category_id',
        'laboratory_id',
    ];
}
