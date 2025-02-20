<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaboratoryCategory>
 */
class LaboratoryCategoryFactory extends Factory
{
    public function definition(): array
{
    static $usedCombinations = [];

    do {
        $category_id = Category::inRandomOrder()->first()->id;
        $laboratory_id = Laboratory::inRandomOrder()->first()->id;
        $key = $category_id . '-' . $laboratory_id;
    } while (isset($usedCombinations[$key]));

    $usedCombinations[$key] = true;

    return [
        'category_id' => $category_id,
        'laboratory_id' => $laboratory_id,
    ];
}

}
