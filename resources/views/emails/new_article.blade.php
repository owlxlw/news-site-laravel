<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новая статья</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background: #f4f4f4;">
        <div style="background: white; padding: 20px; border-radius: 10px;">
            <h1 style="color: #2c3e50;">📰 Новая статья</h1>
            
            <p>На сайте опубликована новая статья:</p>
            
            <h2 style="color: #2c3e50;">{{ $article->title }}</h2>
            
            <p><strong>Дата публикации:</strong> {{ $article->created_at->format('d.m.Y H:i') }}</p>
            
            <p><strong>Краткое описание:</strong><br>
            {{ $article->short_description ?? \Illuminate\Support\Str::limit($article->content, 200) }}</p>
            
            <div style="margin-top: 30px;">
                <a href="{{ url('/news/' . $article->id) }}" 
                   style="background: #2c3e50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
                    Читать статью
                </a>
            </div>
            
            <hr style="margin: 20px 0; border: none; border-top: 1px solid #ddd;">
            
            <p style="color: #666; font-size: 12px;">
                Это письмо отправлено автоматически с сайта "Новостной сайт".
            </p>
        </div>
    </div>
</body>
</html>
