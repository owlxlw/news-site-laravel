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
        if (Gate::denies('moderator')) {
            abort(403, 'У вас нет прав для создания новостей.');
        }
        return view('articles.create');
    }

    public function store(Request $request)
    {
        if (Gate::denies('moderator')) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:200',
            'short_description' => 'nullable|string|max:500',
            'content' => 'required|string|min:10',
            'image' => 'nullable|url|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Article::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'content' => $request->content,
            'image' => $request->image,
            'views' => 0,
            'is_published' => true,
        ]);

        return redirect()->route('articles.index')->with('success', 'Новость успешно создана!');
    }

    public function edit($id)
    {
        if (Gate::denies('moderator')) {
            abort(403, 'У вас нет прав для редактирования новостей.');
        }
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('moderator')) {
            abort(403);
        }
        $article = Article::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:200',
            'short_description' => 'nullable|string|max:500',
            'content' => 'required|string|min:10',
            'image' => 'nullable|url|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $article->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'content' => $request->content,
            'image' => $request->image,
        ]);

        return redirect()->route('articles.index')->with('success', 'Новость успешно обновлена!');
    }

    public function destroy($id)
    {
        if (Gate::denies('moderator')) {
            abort(403);
        }
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Новость успешно удалена!');
    }
}
