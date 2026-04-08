@extends('layouts.app')

@section('title', 'Главная - Новости')

@section('content')
    <div class="card">
        <h1>Новости</h1>
        
        @if(!empty($articles))
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #ddd; padding: 8px; background: #2c3e50; color: white; width: 10%;">Дата</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background: #2c3e50; color: white; width: 25%;">Название</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background: #2c3e50; color: white; width: 45%;">Краткое описание</th>
                        <th style="border: 1px solid #ddd; padding: 8px; background: #2c3e50; color: white; width: 20%;">Превью</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr>
                            <td style="border: 1px solid #ddd; padding: 8px;">{{ $article['date'] }}</td>
                            <td style="border: 1px solid #ddd; padding: 8px;">
                                <strong>{{ $article['name'] }}</strong>
                            </td>
                            <td style="border: 1px solid #ddd; padding: 8px; word-wrap: break-word;">
                                {{ \Illuminate\Support\Str::limit($article['shortDesc'] ?? $article['desc'], 100) }}
                            </td>
                            <td style="border: 1px solid #ddd; padding: 8px; text-align: center;">
                                <a href="{{ route('gallery', ['imageName' => $article['preview_image']]) }}">
                                    <img src="{{ asset($article['preview_image']) }}" alt="preview" style="max-width: 80px; border-radius: 5px;">
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Новостей пока нет.</p>
        @endif
    </div>
@endsection
