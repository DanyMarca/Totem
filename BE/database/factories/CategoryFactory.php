<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'caption_intro' => $this->faker->sentence(),
            'caption_specific' => $this->faker->text(),
            'color' => $this->faker->hexColor(),
        ];
    }
}
