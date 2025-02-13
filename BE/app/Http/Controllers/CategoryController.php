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

    private function findImage($obj)
    {
        $images = $obj->filestorageable()
            ->select('path', 'orientation')
            ->whereIn('orientation', ['horizontal', 'vertical'])
            ->get()
            ->keyBy('orientation');

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

            // Mantiene solo un'immagine orizzontale e una verticale
            $filteredImages = array_filter([
                'horizontal' => $images['horizontal'],
                'vertical' => $images['vertical']
            ]);

            // Assegna solo le immagini disponibili
            $category->image = array_values($filteredImages);

            $type = $category->type === 'liceo' ? 'Liceo' : 'Tecnico';

            // Aggiunge al carosello solo se c'è un'immagine orizzontale
            if ($images['horizontal']) {
                $data[$type]['carosello'][] = $images['horizontal']->path;
            }

            // Aggiunge sempre la categoria
            $data[$type]['categories'][] = $category;
        }

        return response()->json([
            'status' => 'success',
            'cards' => array_map(fn($name, $info) => ['name' => $name] + $info, array_keys($data), $data)
        ], 200);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $category->image = array_values(array_filter($this->findImage($category)));

        $category->laboratories->each(function ($lab) {
            $lab->image = array_values(array_filter($this->findImage($lab)));
        });

        return response()->json([
            'status' => 'success',
            'category' => $category->only(['name', 'caption_intro', 'caption_specific', 'color', 'image']),
            'subjects' => $category->subjects->map->only(['id', 'name', '1_year', '2_year', '3_year', '4_year', '5_year']),
            'laboratories' => $category->laboratories->map->only(['id', 'name', 'image']),
        ], 200);
    }
}
