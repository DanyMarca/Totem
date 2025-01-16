<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

use function PHPSTORM_META\type;

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
            'type' => $this->faker->randomElement(['liceo', 'tecnico']),
            'caption_intro' => $this->faker->sentence(),
            'caption_specific' => $this->faker->text(),
            'color' => $this->faker->hexColor(),
        ];
    }
}
