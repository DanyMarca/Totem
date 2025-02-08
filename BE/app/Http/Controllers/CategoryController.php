<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Builder\Class_;

class CategoryController extends Controller
{
    public function findImage($obj){
        $image = $obj->filestorageable()->select('path','orientation')->get();
        $obj->image = $image->isNotEmpty() ? $image : null;
    }
    public function index(){
        $categories = Category::all();
        $lyceum = [];
        $technician = [];
        $lyceumCarosello = [];
        $technicianCarosello = [];

        foreach ($categories as $category) {
            $this->findImage($category);

            // Aggiungi la prima immagine al carosello specifico per tipo se disponibile
            if ($category->image && $category->image->isNotEmpty()) {
                if ($category->type == 'liceo') {
                    $lyceumCarosello[] = $category->image->first()->path;
                } elseif ($category->type == 'tecnico') {
                    $technicianCarosello[] = $category->image->first()->path;
                }
            }

            if ($category->type == 'liceo') {
                $lyceum[] = $category;
            } elseif ($category->type == 'tecnico') {
                $technician[] = $category;
            }
        }
        return response()->json([
            'status' => 'success',
            'cards'=> [
                [
                "name" => "Liceo",
                'carosello' => $lyceumCarosello,
                "Categories" => $lyceum,

            ],
            [
                "name" => "Tecnico",
                'carosello' => $technicianCarosello,
                "Categories" => $technician,

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
