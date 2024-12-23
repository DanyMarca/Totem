<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilestorageController extends Controller

{
    public function storeFile(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('uploads', 'public'); // Salva il file nel disco 'public'

            return response()->json([
                'path' => $path,
                'text' => $request->input('text'),
            ], 200);
        }

        return response()->json([
            'error' => 'File non ricevuto',
        ], 400);
    }
}
