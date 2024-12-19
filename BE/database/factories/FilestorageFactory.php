<?php

namespace Database\Factories;

use App\Models\Artifact;
use App\Models\Category;
use App\Models\FileStorage;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Filestorage>
 */
class FileStorageFactory extends Factory
{
    protected $model = FileStorage::class;

    public function definition()
    {
        $obj = $this->faker->randomElement([Category::class,Artifact::class,Laboratory::class]);
        return [
            'file_url' => $this->faker->imageUrl(),
            'orientation' => $this->faker->randomElement(['landscape', 'portrait']),
            'filestorageable_id' => $obj::inRandomOrder()->first()->id,
            'filestorageable_type' => $obj
        ];
    }
}
