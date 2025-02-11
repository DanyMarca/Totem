<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Builder\Class_;

class CategoryController extends Controller
{
    public function findImage($obj, $orientation = "")
    {
        $query = $obj->filestorageable()->select('path', 'orientation');

        if (!empty($orientation)) {
            $query->where('orientation', $orientation);
        }

        return $query->get();
    }
    public function index()
    {
        $categories = Category::all();
        $lyceum = [];
        $technician = [];
        $lyceumCarosello = [];
        $technicianCarosello = [];
        foreach ($categories as $category) {
            $category->image = $this->findImage($category, "horizontal");
            info($category);
            if ($category->image->isNotEmpty()) {
                $firstImage = $category->image->first();
                
                if ($category->type === 'liceo') {
                    $lyceumCarosello[] = $firstImage->path;
                    $lyceum[] = $category;
                } elseif ($category->type === 'tecnico') {
                    $technicianCarosello[] = $firstImage->path;
                    $technician[] = $category;
                }
            }
        }

        return response()->json([
            'status' => 'success',
            'cards' => [
                [
                    "name" => "Liceo",
                    'carosello' => $lyceumCarosello,
                    "categories" => $lyceum,
                ],
                [
                    "name" => "Tecnico",
                    'carosello' => $technicianCarosello,
                    "categories" => $technician,
                ],
            ]
        ], 200);
    }
    


    public function show($id){
        $category = Category::find($id);
        $this->findImage($category);
        $category->laboratories->each(function($laboratory){
            $this->findImage($laboratory);
        });

        return response()->json([
            'status' => 'success',
            'category' => $category->only('name', 'caption_intro', 'caption_specific', 'color', 'image'),
            'subjects' => $category->subjects->map(function($subject){
                return $subject->only('id', 'name', '1_year', '2_year', '3_year', '4_year', '5_year');
            }),
            'laboratories' => $category->laboratories->map(function($laboratory){
                return $laboratory->only('id', 'name', 'image');
            }),

        ], 200);
    }
}
