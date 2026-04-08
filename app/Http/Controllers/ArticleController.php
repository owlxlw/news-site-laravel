<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    // Отображение списка новостей (с пагинацией)
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
    
    // Показать форму создания новости
    public function create()
    {
        return view('articles.create');
    }
    
    // Сохранить новую новость
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:200',
            'short_description' => 'nullable|string|max:500',
            'content' => 'required|string|min:10',
            'image' => 'nullable|url|max:500',
        ], [
            'title.required' => 'Название обязательно',
            'title.min' => 'Название должно быть не менее 3 символов',
            'content.required' => 'Содержание обязательно',
            'content.min' => 'Содержание должно быть не менее 10 символов',
            'image.url' => 'Введите корректный URL изображения',
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
    
    // Показать форму редактирования
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }
    
    // Обновить новость
    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:3|max:200',
            'short_description' => 'nullable|string|max:500',
            'content' => 'required|string|min:10',
            'image' => 'nullable|url|max:500',
        ], [
            'title.required' => 'Название обязательно',
            'title.min' => 'Название должно быть не менее 3 символов',
            'content.required' => 'Содержание обязательно',
            'content.min' => 'Содержание должно быть не менее 10 символов',
            'image.url' => 'Введите корректный URL изображения',
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
    
    // Удалить новость
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        
        return redirect()->route('articles.index')->with('success', 'Новость успешно удалена!');
    }
}
