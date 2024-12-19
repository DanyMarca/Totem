<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Artifact;
use App\Models\Category;
use App\Models\Laboratory;
use App\Models\Filestorage;
use Illuminate\Support\Facades\Log;

class RelationTestController extends Controller
{
    public function checkRelations()
    {
        $results = [];

        try {
            // Test User -> Artifacts (hasMany)
            $user = User::factory()->hasArtifacts(3)->create();
            if ($user->artifacts->count() === 3) {
                $results['User -> Artifacts'] = 'OK';
            }

            // Test Artifact -> User (belongsTo)
            $artifact = Artifact::factory()->for($user)->create();
            if ($artifact->user->is($user)) {
                $results['Artifact -> User'] = 'OK';
            }

            // Test Artifact -> Categories (belongsToMany)
            $artifact = Artifact::factory()->create();
            $categories = Category::factory(2)->create();
            $artifact->categories()->attach($categories->pluck('id'));
            if ($artifact->categories->count() === 2) {
                $results['Artifact -> Categories'] = 'OK';
            }

            // Test Category -> Artifacts (belongsToMany)
            $category = $categories->first();
            if ($category->artifacts->count() > 0) {
                $results['Category -> Artifacts'] = 'OK';
            }

            // Test Polymorphic Relations (Artifact -> Files)
            $artifact = Artifact::factory()->create();
            $file = Filestorage::factory()->create([
                'photos_able_id' => $artifact->id,
                'photos_able_type' => Artifact::class,
            ]);
            if ($artifact->files->first()->is($file)) {
                $results['Artifact -> Files'] = 'OK';
            }

            // Test Laboratory -> Categories (belongsToMany)
            $laboratory = Laboratory::factory()->create();
            $category = Category::factory()->create();
            $laboratory->categories()->attach($category->id);
            if ($laboratory->categories->count() === 1) {
                $results['Laboratory -> Categories'] = 'OK';

            // Test Subject -> Category (belongsTo)
            $category = Category::factory()->create();
            $subject = Subject::factory()->for($category)->create();
            if ($subject->category->is($category)) {
                $results['Subject -> Category'] = 'OK';
            }

            // Test Category -> Subjects (hasMany)
            $category = Category::factory()->hasSubjects(3)->create();
            if ($category->subjects->count() === 3) {
                $results['Category -> Subjects'] = 'OK';
            }

            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $results['Error'] = $e->getMessage();
        }

        return response()->json($results);
    }
}
