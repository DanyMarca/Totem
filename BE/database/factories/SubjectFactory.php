<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = \App\Models\Subject::class;

    public function definition()
    {
        return [
            'category_id' => \App\Models\Category::factory(), // Relazione con Category
            'name' => $this->faker->word(),
            '1_year' => $this->faker->randomDigitNotNull(),
            '2_year' => $this->faker->randomDigitNotNull(),
            '3_year' => $this->faker->randomDigitNotNull(),
            '4_year' => $this->faker->randomDigitNotNull(),
            '5_year' => $this->faker->randomDigitNotNull(),
        ];
    }
}
