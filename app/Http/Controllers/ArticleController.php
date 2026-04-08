<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Отображение списка новостей
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        return view('articles.index', compact('articles'));
    }
    
    // Отображение одной новости
    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('views');
        return view('articles.show', compact('article'));
    }
}
