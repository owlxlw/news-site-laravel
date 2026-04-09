@extends('layouts.app')

@section('title', 'Модерация комментариев')

@section('content')
    <div class="card">
        <h1>Модерация комментариев</h1>
        
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif
        
        @if($pendingComments->count() > 0)
            @foreach($pendingComments as $comment)
                <div style="border-bottom: 1px solid #ddd; padding: 15px 0;">
                    <div style="background: #fff3cd; padding: 15px; border-radius: 8px; border-left: 4px solid #ffc107;">
                        <p><strong>К статье:</strong> <a href="{{ route('articles.show', $comment->article->id) }}">{{ $comment->article->title }}</a></p>
                        <p><strong>Автор:</strong> {{ $comment->user->name }}</p>
                        <p><strong>Комментарий:</strong></p>
                        <p style="background: white; padding: 10px; border-radius: 5px;">{{ $comment->content }}</p>
                        <p><strong>Дата:</strong> {{ $comment->created_at->format('d.m.Y H:i') }}</p>
                        
                        <div style="margin-top: 15px;">
                            <form method="POST" action="{{ route('comments.approve', $comment->id) }}" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" style="background: #27ae60; color: white; padding: 8px 20px; border: none; border-radius: 5px; cursor: pointer;">✅ Одобрить</button>
                            </form>
                            
                            <form method="POST" action="{{ route('comments.reject', $comment->id) }}" style="display: inline; margin-left: 10px;">
                                @csrf
                                @method('PUT')
                                <button type="submit" style="background: #e74c3c; color: white; padding: 8px 20px; border: none; border-radius: 5px; cursor: pointer;">❌ Отклонить</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>Нет комментариев, ожидающих модерации.</p>
        @endif
    </div>
@endsection
