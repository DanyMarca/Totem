<?php

namespace Database\Factories;

use App\Models\FileStorage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Filestorage>
 */
class FileStorageFactory extends Factory
{
    protected $model = FileStorage::class;

    public function definition()
    {
        return [
            'file_url' => $this->faker->imageUrl(),
            'caption' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTime(),
            'photos_able_id' => null,
            'photos_able_type' => null,
        ];
    }
}
