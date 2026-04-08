@extends('layouts.app')

@section('title', 'Редактировать новость')

@section('content')
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <h1>Редактировать новость</h1>

        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul>
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
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Название *</label>
                <input type="text" name="title" value="{{ old('title', $article->title) }}" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Краткое описание</label>
                <textarea name="short_description" rows="3" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{ old('short_description', $article->short_description) }}</textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">Содержание *</label>
                <textarea name="content" rows="10" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">{{ old('content', $article->content) }}</textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: bold;">URL изображения</label>
                <input type="url" name="image" value="{{ old('image', $article->image) }}" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            </div>

            <button type="submit" style="background: #f39c12; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Обновить</button>
            <a href="{{ route('articles.index') }}" style="background: #95a5a6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Отмена</a>
        </form>
    </div>
@endsection
