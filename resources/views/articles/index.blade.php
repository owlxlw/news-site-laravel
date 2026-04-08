@extends('layouts.app')

@section('title', 'Все новости')

@section('content')
    <div class="card">
        <h1>Все новости</h1>
        
        @if($articles->count() > 0)
            @foreach($articles as $article)
                <div style="border-bottom: 1px solid #ddd; padding: 15px 0;">
                    <h2>
                        <a href="{{ route('articles.show', $article->id) }}" style="color: #2c3e50; text-decoration: none;">
                            {{ $article->title }}
                        </a>
                    </h2>
                    <div style="color: #666; margin-bottom: 10px;">
                        📅 {{ $article->created_at->format('d.m.Y') }} | 👁️ {{ $article->views }} просмотров
                    </div>
                    <p>{{ $article->short_description ?? \Illuminate\Support\Str::limit($article->content, 150) }}</p>
                    
                    @can('moderator')
                        <div style="margin-top: 10px;">
                            <a href="{{ route('articles.edit', $article->id) }}" style="color: #f39c12; text-decoration: none; margin-right: 10px;">✏️ Редактировать</a>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer;" onclick="return confirm('Удалить новость?')">🗑️ Удалить</button>
                            </form>
                        </div>
                    @endcan
                </div>
            @endforeach
            
            <div style="margin-top: 30px; text-align: center;">
                {{ $articles->links() }}
            </div>
        @else
            <p>Новостей пока нет.</p>
        @endif
    </div>
@endsection
