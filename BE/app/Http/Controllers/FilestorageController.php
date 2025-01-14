<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use App\Models\Filestorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilestorageController extends Controller

{
    public function storeFile(Request $request)
    {
        try {
            // Validazione del file
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Creazione del nome file e salvataggio
            $image = $request->file('image');
            $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            $storedFileName = str_replace(' ', '-', $fileName) . '_' . time() . '.' . $extension;

            $image->storeAs('public', $storedFileName);

            // Creazione del record nella tabella FileStorage
            $file = Filestorage::create([
                'path' => config('app.url') . ':8000/storage/' . $storedFileName,
                'orientation' => implode('x', getimagesize($image)), // "larghezza x altezza"
                'filestorageable_type' => Artifact::class,
                'filestorageable_id' => 1,
            ]);

            return response()->json([
                'success' => 'File uploaded successfully',
                'path' => $file,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error during file upload',
                'message' => $e->getMessage(),
            ], 400);
        }
    }



    public function show_path($id)
    {
        $file = Filestorage::find($id);
        if ($file) {
            return response()->json([
                'env' => config('app.url'),
                'path' => $file->path,
            ], 200);
        }

        return response()->json([
            'error' => 'File non trovato',
        ], 404);
    }
}
