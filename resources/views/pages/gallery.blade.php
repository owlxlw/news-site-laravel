@extends('layouts.app')

@section('title', 'Галерея')

@section('content')
    <div class="card">
        <h1>Просмотр изображения</h1>
        
        <div style="text-align: center; margin: 20px 0;">
            <img src="{{ asset($imageName) }}" alt="full image" style="max-width: 100%; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        </div>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('home') }}" style="color: #2c3e50; text-decoration: none;">← Вернуться к новостям</a>
        </div>
    </div>
@endsection
