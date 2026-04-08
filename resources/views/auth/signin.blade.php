@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <div class="card" style="max-width: 500px; margin: 0 auto;">
        <h1>Регистрация</h1>
        
        @if(session('success'))
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('signin.post') }}">
            @csrf
            
            <div style="margin-bottom: 15px;">
                <label for="name" style="display: block; margin-bottom: 5px; font-weight: bold;">Имя:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; margin-bottom: 5px; font-weight: bold;">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="password" style="display: block; margin-bottom: 5px; font-weight: bold;">Пароль:</label>
                <input type="password" name="password" id="password" 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label for="password_confirmation" style="display: block; margin-bottom: 5px; font-weight: bold;">Подтверждение пароля:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" required>
            </div>
            
            <button type="submit" style="background: #2c3e50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                Зарегистрироваться
            </button>
        </form>
        
        <div style="margin-top: 15px; text-align: center;">
            <a href="{{ route('home') }}" style="color: #2c3e50;">Вернуться на главную</a>
        </div>
    </div>
@endsection
