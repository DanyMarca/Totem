<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{FileStorage, Laboratory, Category, Artifact, User, ArtifactCategory, LaboratoryCategory, Log, Subject};

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Esempi di esecuzione delle factory
        echo("1° User\n");
        User::factory(3)->create();
        echo("2° Logs\n");
        Log::factory(10)->create(); 
        echo("3° Category\n");
        Category::factory(5)->create(); 
        echo("4° Laboratory\n");
        Laboratory::factory(10)->create(); 
        echo("5° Artifact\n");
        Artifact::factory(10)->create(); 
        echo("6° ArtifactCategory\n");
        ArtifactCategory::factory(10)->create(); 
        echo("7° LaboratoryCategory\n");
        LaboratoryCategory::factory(10)->create();
        echo("8° Filestorage\n");
        FileStorage::factory(10)->create();  
        echo("9° Subject\n");
        Subject::factory(10)->create();  
        
    }
}

