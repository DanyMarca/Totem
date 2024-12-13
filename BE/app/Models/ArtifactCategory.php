<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ArtifactCategory extends Pivot
{
    use HasFactory;

    protected $table = 'artifact_categories';

    protected $fillable = [
        'category_id',
        'artifact_id',
    ];
}
