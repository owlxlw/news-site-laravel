<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новостной сайт - @yield('title')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; background: #f4f4f4; min-height: 100vh; display: flex; flex-direction: column; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        header { background: #2c3e50; color: white; padding: 1rem 0; }
        nav ul { display: flex; list-style: none; gap: 2rem; flex-wrap: wrap; align-items: center; }
        nav a { color: white; text-decoration: none; font-weight: bold; }
        nav a:hover { color: #f39c12; }
        main { flex: 1; padding: 2rem 0; }
        footer { background: #2c3e50; color: white; text-align: center; padding: 1rem 0; margin-top: auto; }
        .card { background: white; border-radius: 8px; padding: 1.5rem; margin-bottom: 1rem; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; margin-bottom: 1rem; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="{{ route('home') }}">Главная</a></li>
                    <li><a href="{{ route('about') }}">О нас</a></li>
                    <li><a href="{{ route('contacts') }}">Контакты</a></li>
                    
                    @auth
                        @can('moderator')
                            <li><a href="{{ route('comments.pending') }}">Модерация комментариев</a></li>
                            <li><a href="{{ route('articles.create') }}">Создать новость</a></li>
                        @endcan
                        <li style="margin-left: auto;">
                            <span>{{ Auth::user()->name }} ({{ Auth::user()->role->name ?? 'Нет роли' }})</span>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 10px;">
                                @csrf
                                <button type="submit" style="background: #e74c3c; color: white; border: none; padding: 5px 12px; border-radius: 5px; cursor: pointer;">Выйти</button>
                            </form>
                        </li>
                    @else
                        <li style="margin-left: auto;">
                            <a href="{{ route('login') }}">Вход</a>
                            <a href="{{ route('register') }}" style="margin-left: 10px;">Регистрация</a>
                        </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    {{ session('success') }}
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

    <footer>
        <div class="container">
            <p>Маликова Диана | Группа: 243-321</p>
            <p>© {{ date('Y') }} Новостной сайт</p>
        </div>
    </footer>
</body>
</html>
