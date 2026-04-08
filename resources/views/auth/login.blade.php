@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <div class="card" style="max-width: 500px; margin: 0 auto;">
        <h1>Вход в систему</h1>
        
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email *</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Пароль *</label>
                <input type="password" name="password" id="password" 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
            </div>
            
            <button type="submit" style="background: #2c3e50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                Войти
            </button>
            
            <div style="margin-top: 15px;">
                <a href="{{ route('register') }}">Нет аккаунта? Зарегистрироваться</a>
            </div>
        </form>
    </div>
@endsection
