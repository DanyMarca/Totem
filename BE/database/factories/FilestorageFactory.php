<?php

namespace Database\Factories;

use App\Models\Artifact;
use App\Models\Category;
use App\Models\Filestorage;
use App\Models\Laboratory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Filestorage>
 */
class FilestorageFactory extends Factory
{
    protected $model = Filestorage::class;

    public function definition()
    {
        // $obj = $this->faker->randomElement([Category::class,Artifact::class,Laboratory::class]);
        // return [
        //     'path' => $this->faker->imageUrl(),
        //     'orientation' => $this->faker->randomElement(['horizontal', 'vertical']),
        //     'filestorageable_id' => $obj::inRandomOrder()->first()->id,
        //     'filestorageable_type' => $obj
        // ];
    }
}
