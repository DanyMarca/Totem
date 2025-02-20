<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryController extends Controller
{
    public function index() {
    try {
        $laboratories = Laboratory::with('filestorageable')->get()->map(function ($lab) {
            return [
                'id' => $lab->id,
                'name' => $lab->name,
                'description' => $lab->description,
                'images' => $lab->filestorageable->take(5)->map(function ($file) {
                    return [
                        'image_url' => $file->image_url,
                        'orientation' => $file->orientation
                    ];
                })
            ];
        });

        return response()->json([
            'status' => 'success',
            'data' => $laboratories
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Errore',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
