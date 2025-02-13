<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private function getFullPath($path)
    {
        $serverIp = request()->getSchemeAndHttpHost(); // Ottiene "http://{ip_server}"
        return $serverIp . $path;
    }

    private function findImage($obj, $filter = null)
{
    // Recupera le immagini con orientamento 'horizontal' e 'vertical'
    $images = $obj->filestorageable()
        ->select('path', 'orientation')
        ->whereIn('orientation', ['horizontal', 'vertical'])
        ->get()
        ->keyBy('orientation');

    // Se è presente un filtro, restituisci solo l'immagine con quell'orientamento
    if ($filter) {
        // Verifica se l'orientamento richiesto esiste nelle immagini recuperate
        if (isset($images[$filter])) {
            return [
                $filter => (object) [
                    'path' => $this->getFullPath($images->get($filter)->path),
                    'orientation' => $filter,
                ]
            ];
        }

        // Se non viene trovata un'immagine con l'orientamento specificato, restituisci null
        return [
            $filter => null
        ];
    }

    // Se non c'è filtro, restituisci entrambe le immagini (orizzontale e verticale)
    return [
        'horizontal' => $images->get('horizontal') ? (object) [
            'path' => $this->getFullPath($images->get('horizontal')->path),
            'orientation' => 'horizontal'
        ] : null,
        'vertical' => $images->get('vertical') ? (object) [
            'path' => $this->getFullPath($images->get('vertical')->path),
            'orientation' => 'vertical'
        ] : null,
    ];
}


    public function index()
    {
        $categories = Category::all();
        $data = [
            'Liceo' => ['carosello' => [], 'categories' => []],
            'Tecnico' => ['carosello' => [], 'categories' => []]
        ];

        foreach ($categories as $category) {
            $images = $this->findImage($category);
            $category->image = array_values(array_filter($images));

            if ($images['horizontal']) {
                $type = $category->type === 'liceo' ? 'Liceo' : 'Tecnico';
                $data[$type]['carosello'][] = $images['horizontal']->path;
                $data[$type]['categories'][] = $category;
            }
        }

        return response()->json([
            'status' => 'success',
            'cards' => array_map(fn($name, $info) => ['name' => $name] + $info, array_keys($data), $data)
        ], 200);
    }

    public function show($id)
{
    $category = Category::findOrFail($id);
    
    // Trova la prima immagine verticale (opzionale, se serve per la categoria)
    $images = $this->findImage($category, "vertical");
    $category->image = !empty($images) ? array_values(array_filter($images)) : [];

    // Riorganizza i laboratori con la struttura richiesta
    $category->laboratories = $category->laboratories->map(function ($laboratory) {
        // Trova la prima immagine orizzontale
        $images = $this->findImage($laboratory);
        
        // Filtra le immagini per ottenere solo quelle orizzontali
        $horizontalImage = collect($images)->first(function ($image) {
            return $image && $image->orientation === 'horizontal'; // Trova la prima immagine orizzontale
        });

        // Se trovata un'immagine orizzontale, prendi path e orientation
        $imageData = $horizontalImage ? [
            'path' => $horizontalImage->path,
            'orientation' => $horizontalImage->orientation
        ] : null;

        return [
            'id' => $laboratory->id,
            'name' => $laboratory->name,
            'description' => $laboratory->description,
            'image' => $imageData, // Assegna la prima immagine orizzontale, se presente
        ];
    });

    return response()->json([
        'status' => 'success',
        'category' => $category->only(['name', 'caption_intro', 'caption_specific', 'color', 'image']),
        'subjects' => $category->subjects->map->only(['id', 'name', '1_year', '2_year', '3_year', '4_year', '5_year']),
        'laboratories' => $category->laboratories // Restituisci i laboratori con la prima immagine orizzontale
        
    ], 200);
}

}