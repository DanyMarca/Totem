<?php

namespace Database\Factories;

use App\Models\Log;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    protected $model = Log::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'action' => $this->faker->word(),
            'details' => $this->faker->paragraph(),
        ];
    }
}
