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
        
        <!-- Секция комментариев -->
        <div style="margin-top: 40px; border-top: 2px solid #ddd; padding-top: 20px;">
            <h2>Комментарии ({{ $article->approvedComments()->count() }})</h2>
            
            @if($article->approvedComments()->count() > 0)
                @foreach($article->approvedComments as $comment)
                    <div style="background: #f9f9f9; padding: 15px; margin-bottom: 15px; border-radius: 8px;">
                        <strong>{{ $comment->user->name }}</strong>
                        <small style="color: #666;">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                        <p style="margin-top: 10px;">{{ $comment->content }}</p>
                    </div>
                @endforeach
            @else
                <p>Пока нет комментариев. Будьте первым!</p>
            @endif
            
            <!-- Форма добавления комментария -->
            @auth
                <div style="margin-top: 30px; background: #f4f4f4; padding: 20px; border-radius: 8px;">
                    <h3>Добавить комментарий</h3>
                    
                    @if(session('success'))
                        <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('comments.store', $article->id) }}">
                        @csrf
                        <textarea name="content" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" placeholder="Ваш комментарий..."></textarea>
                        <button type="submit" style="margin-top: 10px; background: #2c3e50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Отправить</button>
                    </form>
                </div>
            @else
                <div style="margin-top: 30px; background: #f4f4f4; padding: 20px; border-radius: 8px; text-align: center;">
                    <a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.
                </div>
            @endauth
        </div>
        
        <div style="margin-top: 30px;">
            <a href="{{ route('articles.index') }}" style="color: #2c3e50;">← Назад к списку новостей</a>
        </div>
    </div>
@endsection
