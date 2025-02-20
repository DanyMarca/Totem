<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use Illuminate\Http\Request;

class ArtifactController extends Controller
{
    public function index()
    {
        try {
            $artifacts = Artifact::with('categories','filestorageable')->get();
    
            if ($artifacts->isEmpty()) {
                return response()->json(['message' => 'Nessun artifact trovato'], 404);
            }
    
            $formattedArtifacts = $artifacts->map(fn($artifact) => [
                'id' => $artifact->id,
                'name' => $artifact->name,
                'description' => $artifact->description,
                'image' => $artifact->filestorageable->first() ? $artifact->filestorageable->first()->image_url : null,
                'period' => $artifact->period,
                'material' => $artifact->material,
                'location' => $artifact->location,
                'type' => $artifact->type,
                'priority' => $artifact->priority,
                'color' => optional($artifact->categories->first())->color, // Usa optional() per evitare errori
            ]);
    
            return response()->json($formattedArtifacts);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Errore',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
