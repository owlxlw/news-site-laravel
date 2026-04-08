<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Читаем JSON файл
        $jsonPath = public_path('articles.json');
        $jsonContent = file_get_contents($jsonPath);
        $articles = json_decode($jsonContent, true);
        
        // Передаём данные в представление
        return view('pages.home', compact('articles'));
    }
    
    public function gallery($imageName)
    {
        $fullImagePath = asset('public/' . $imageName);
        return view('pages.gallery', compact('fullImagePath', 'imageName'));
    }
}
