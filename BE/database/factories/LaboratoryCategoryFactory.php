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
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'category_id' => Category::inRandomOrder()->first()->id,
            'category_id' => rand(1,10),
            'laboratory_id' => Laboratory::inRandomOrder()->first()->id,
        ];
    }
}
