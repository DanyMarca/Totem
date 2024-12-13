<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Laboratory>
 */
class LaboratoryFactory extends Factory
{
    protected $model = Laboratory::class;

    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
