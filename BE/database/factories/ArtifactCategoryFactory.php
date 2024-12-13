<?php

namespace Database\Factories;

use App\Models\Artifact;
use App\Models\Category;
use App\Models\ArtifactCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArtifactCategory>
 */
class ArtifactCategoryFactory extends Factory
{
    protected $model = ArtifactCategory::class;

    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'artifact_id' => Artifact::factory(),
        ];
    }
}