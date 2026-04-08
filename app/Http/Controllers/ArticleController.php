<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        return view('articles.index', compact('articles'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('views');
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        // Простейший тест
        return "Метод create работает! Форма создания новости откроется позже.";
    }

    public function store(Request $request)
    {
        // Временно пусто
        return redirect()->route('articles.index');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        return redirect()->route('articles.index');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('articles.index');
    }
}
