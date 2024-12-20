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
            $user = User::with('artifacts')->first();
            if ($user && $user->artifacts) {
                $results['User -> Artifacts'] = 'OK';
            } else {
                $results['User -> Artifacts'] = 'FAILED';
            }

            // Test Artifact -> User (belongsTo)
            $artifact = Artifact::with('users')->first();
            if ($artifact && $artifact->users) {
                $results['Artifact -> User'] = 'OK';
            } else {
                $results['Artifact -> User'] = 'FAILED';
            }

            // Test Artifact -> Categories (belongsToMany)
            $artifact = Artifact::with('categories')->first();
            if ($artifact && $artifact->categories) {
                $results['Artifact -> Categories'] = 'OK';
            } else {
                $results['Artifact -> Categories'] = 'FAILED';
            }

            // Test Category -> Artifacts (belongsToMany)
            $category = Category::with('artifacts')->first();
            if ($category && $category->artifacts) {
                $results['Category -> Artifacts'] = 'OK';
            } else {
                $results['Category -> Artifacts'] = 'FAILED';
            }

            // Test Polymorphic Relations (Artifact -> Files)
            $artifact = Artifact::with('files')->first();
            if ($artifact && $artifact->files) {
                $results['Artifact -> Files'] = 'OK';
            } else {
                $results['Artifact -> Files'] = 'FAILED';
            }

            // Test Laboratory -> Categories (belongsToMany)
            $laboratory = Laboratory::with('categories')->first();
            if ($laboratory && $laboratory->categories) {
                $results['Laboratory -> Categories'] = 'OK';
            } else {
                $results['Laboratory -> Categories'] = 'FAILED';
            }

            // Test Subject -> Category (belongsTo)
            $subject = Subject::with('category')->first();
            if ($subject && $subject->category) {
                $results['Subject -> Category'] = 'OK';
            } else {
                $results['Subject -> Category'] = 'FAILED';
            }

            // Test Category -> Subjects (hasMany)
            $category = Category::with('subjects')->first();
            if ($category && $category->subjects) {
                $results['Category -> Subjects'] = 'OK';
            } else {
                $results['Category -> Subjects'] = 'FAILED';
            }

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $results['Error'] = $e->getMessage();
        }

        return response()->json($results);
    }
}
