@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="card">
        <h1>{{ $article->title }}</h1>
        
        <div style="color: #666; margin-bottom: 20px;">
            📅 {{ $article->created_at->format('d.m.Y') }} | 👁️ {{ $article->views }} просмотров
        </div>
        
        @if($article->image)
            <div style="margin-bottom: 20px;">
                <img src="{{ $article->image }}" alt="{{ $article->title }}" style="max-width: 100%; border-radius: 10px;">
            </div>
        @endif
        
        <div style="line-height: 1.8;">
            {!! nl2br(e($article->content)) !!}
        </div>
        
        <div style="margin-top: 30px;">
            <a href="{{ route('articles.index') }}" style="color: #2c3e50;">← Назад к списку новостей</a>
        </div>
    </div>
@endsection
