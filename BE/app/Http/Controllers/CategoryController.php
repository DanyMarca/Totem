<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        $lyceum = [];
        $technician = [];
        foreach ($categories as $category) {
            if($category->type == 'liceo'){
                $image = $category->filestorageable()->select('path','orientation')->first();
                $imagePath   = $image ? $image->path : null;
                $category->image = $imagePath;
                $category->orientation = $image ? $image->orientation : null;
                $lyceum[] = $category;


            }if($category->type == 'tecnico'){
                $image = $category->filestorageable()->select('path','orientation')->first();
                $imagePath   = $image ? $image->path : null;
                $category->image = $imagePath;
                $category->orientation = $image ? $image->orientation : null;
                $technician[] = $category;
            }
        }
        return response()->json([
            'status' => 'success',
            'Lyceum' => [
                "name" => "Liceo",
                "Categories" => $lyceum,
            ],
            'technician' => [
                "name" => "Tecnico",
                "Categories" => $technician,
            ],
        ], 200);
    }
}



// {
// 	status: "sucsess",
// 	Lyceum :{
// 		name:$name,
// 		image:$path,
// 		Categories:[
// 			{
// 			id:$id,
// 			type:$type,
// 			name:$name,
// 			image:$path,
// 			color:$hash,
// 			description: $description_intro,
// 			description_image: $path,
// 			},
// 			{}
// 		]
// 	}
// 	technician:
// 		{
// 		name:$name,
// 		image:$path,
// 		Categories:[
// 			{
// 			id:$id,
// 			type:$type,
// 			name:$name,
// 			image:$path,
// 			color:$hash,
// 			description: $description_intro,
// 			description_image: $path,
// 			},
// 			{}
// 		]
// 	}
// }