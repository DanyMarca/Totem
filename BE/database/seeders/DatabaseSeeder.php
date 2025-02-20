<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Database\Seeders\FilestorageSeeder as SeedersFilestorageSeeder;
use App\Models\{FileStorage, Laboratory, Category, Artifact, User, ArtifactCategory, LaboratoryCategory, Log, Subject};

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Storage::deleteDirectory('public');
        echo "Filestorage table deleted\n";
        Storage::makeDirectory('public');
        
        DB::table('users')->insert([
            'username' => 'Admin',
            'email' => 'admin'.'@example.com',
            'password' => Hash::make('password'),
        ]);

        echo("1° User\n");
        User::factory(1)->create();
        echo("2° Logs\n");
        Log::factory(10)->create();
        echo("3° Category\n");
        Category::factory(10)->create();
        echo("4° Laboratory\n");
        Laboratory::factory(10)->create();
        echo("5° Artifact\n");
        Artifact::factory(10)->create();
        echo("6° ArtifactCategory\n");
        ArtifactCategory::factory(10)->create();
        echo("7° LaboratoryCategory\n");
        LaboratoryCategory::factory(10)->create();
        echo("8° Filestorage\n");
        $this->call(FilestorageSeeder::class);
        // FileStorage::factory(10)->create();
        echo("9° Subject\n");
        Subject::factory(30)->create();

    }
}

