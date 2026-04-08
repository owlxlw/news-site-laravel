@extends('layouts.app')

@section('title', 'Редактировать новость')

@section('content')
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <h1>Редактировать новость</h1>
        
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('articles.update', $article->id) }}">
            @csrf
            @method('PUT')
            
            <div style="margin-bottom: 15px;">
                <label for="title" style="display: block; margin-bottom: 5px; font-weight: bold;">Название *</label>
                <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="short_description" style="display: block; margin-bottom: 5px; font-weight: bold;">Краткое описание</label>
                <textarea name="short_description" id="short_description" rows="3" 
                          style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{ old('short_description', $article->short_description) }}</textarea>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="content" style="display: block; margin-bottom: 5px; font-weight: bold;">Содержание *</label>
                <textarea name="content" id="content" rows="10" 
                          style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>{{ old('content', $article->content) }}</textarea>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="image" style="display: block; margin-bottom: 5px; font-weight: bold;">URL изображения</label>
                <input type="url" name="image" id="image" value="{{ old('image', $article->image) }}" 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>
            
            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #f39c12; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Обновить</button>
                <a href="{{ route('articles.index') }}" style="background: #95a5a6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px;">Отмена</a>
            </div>
        </form>
    </div>
@endsection
