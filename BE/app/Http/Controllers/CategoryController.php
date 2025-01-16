<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Builder\Class_;

class CategoryController extends Controller
{
    public function findImage($category){
        $image = $category->filestorageable()->select('path','orientation')->get();
        $category->image = $image->isNotEmpty() ? $image : null;
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
            'Lyceum' => [
                "name" => "Liceo",
                'carosello' => $lyceumCarosello,
                "Categories" => $lyceum,
                
            ],
            'technician' => [
                "name" => "Tecnico",
                'carosello' => $technicianCarosello,
                "Categories" => $technician,
                
            ],
        ], 200);
    }
}
