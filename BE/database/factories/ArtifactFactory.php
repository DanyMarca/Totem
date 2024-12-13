<?php

namespace Database\Factories;

use App\Models\Artifact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artifact>
 */
class ArtifactFactory extends Factory
{
    protected $model = Artifact::class;

    public function definition()
    {

        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
            'period' => $this->faker->year(),
            'material' => $this->faker->word(),
            'location' => $this->faker->city(),
            'user_id' => User::inRandomOrder()->first()->id,
            'type' => $this->faker->randomElement(['event', 'object']),
            'priority' => $this->faker->numberBetween(1, 10),
        ];
    }
}
