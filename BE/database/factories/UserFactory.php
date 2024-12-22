<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'email'=> $this->faker->email(),
            'username' => $this->faker->userName(),
            'password' => bcrypt('password'),
            'role' => $this->faker->randomElement(['admin', 'collaborator']),
        ];
    }
}