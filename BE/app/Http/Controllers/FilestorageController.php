<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use App\Models\FileStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilestorageController extends Controller

{
    public function storeFile(Request $request)
    {
        try{
            $file = new FileStorage();
            if($request->hasFile('image')) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                $completeFileName = $request->file('image')->getClientOriginalName();
                $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
                $extenshion = $request->file('image')->getClientOriginalExtension();
                $compPic = str_replace(' ','-', $fileNameOnly). '_'.time(). '.'. $extenshion;
                $path = $request->file('image')->storeAs('public', $compPic);
                // completamento record
                //il file storage ha bisgno della porta 8000 per il servizio di laravele /storage/ per arrivare alla cartella giusta
                $file->path = config('app.url').':8000/storage/'. $compPic;
                list($width, $height) = getimagesize($request->file('image'));
                $file->orientation = $width.'x'. $height;
                $file->filestorageable_type = Artifact::class;
                $file->filestorageable_id = 1;
            }
            if($file->save()) {
                return response()->json([
                    'success' => 'File uploaded successfully',
                    'path' => $file
                ], 200);
            } else {
                return response()->json([
                    'error' => 'Error during file upload'
                ], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error during file upload',
                'message' => $e->getMessage()
            ], 400);
        }
    }


    public function show_path($id)
    {
        $file = FileStorage::find($id);
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
