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
                </div>
            @endforeach
            
            <!-- Компактная пагинация -->
            <div style="margin-top: 30px; text-align: center;">
                @if ($articles->onFirstPage())
                    <span style="padding: 8px 12px; background: #ccc; color: #666; border-radius: 5px;">◀ Назад</span>
                @else
                    <a href="{{ $articles->previousPageUrl() }}" style="padding: 8px 12px; background: #2c3e50; color: white; text-decoration: none; border-radius: 5px;">◀ Назад</a>
                @endif
                
                <span style="margin: 0 15px; color: #2c3e50;">
                    Страница {{ $articles->currentPage() }} из {{ $articles->lastPage() }}
                </span>
                
                @if ($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}" style="padding: 8px 12px; background: #2c3e50; color: white; text-decoration: none; border-radius: 5px;">Вперед ▶</a>
                @else
                    <span style="padding: 8px 12px; background: #ccc; color: #666; border-radius: 5px;">Вперед ▶</span>
                @endif
            </div>
        @else
            <p>Новостей пока нет.</p>
        @endif
    </div>
@endsection
