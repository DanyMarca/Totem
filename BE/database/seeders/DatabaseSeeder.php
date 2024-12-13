<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{FileStorage, Laboratory, Category, Artifact, User, ArtifactCategory, Log};

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Esempi di esecuzione delle factory
        echo("Category\n");
        Category::factory(5)->create(); 
        echo("Laboratory\n");
        Laboratory::factory(10)->create(); 
        echo("User\n");
        User::factory(3)->create(); 
        echo("Artifact\n");
        Artifact::factory(2)->create(); 
        echo("ArtifactCategory\n");
        ArtifactCategory::factory(2)->create(); 
        echo("Logs\n");
        Log::factory(2)->create(); 

        
    }
}

