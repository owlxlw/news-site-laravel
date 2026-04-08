<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Показать форму регистрации
    public function showRegisterForm()
    {
        return view('auth.register');
    }
    
    // Регистрация пользователя
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:50',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Имя обязательно',
            'name.min' => 'Имя должно быть не менее 2 символов',
            'email.required' => 'Email обязателен',
            'email.email' => 'Введите корректный email',
            'email.unique' => 'Этот email уже зарегистрирован',
            'password.required' => 'Пароль обязателен',
            'password.min' => 'Пароль должен быть не менее 6 символов',
            'password.confirmed' => 'Пароли не совпадают',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        // Создаём токен
        $token = $user->createToken('auth_token')->plainTextToken;
        
        // Автоматически логиним пользователя
        Auth::login($user);
        
        return redirect()->route('home')->with('success', 'Регистрация прошла успешно!');
    }
    
    // Показать форму логина
    public function showLoginForm()
    {
        return view('auth.login');
    }
    
    // Авторизация пользователя
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email обязателен',
            'email.email' => 'Введите корректный email',
            'password.required' => 'Пароль обязателен',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return redirect()->intended('/')->with('success', 'Добро пожаловать!');
        }
        
        return redirect()->back()->withErrors([
            'email' => 'Неверный email или пароль',
        ])->withInput();
    }
    
    // Выход пользователя
    public function logout(Request $request)
    {
        // Удаляем токены
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }
        
        // Выход из системы
        Auth::logout();
        
        // Аннулируем сессию
        $request->session()->invalidate();
        
        // Обновляем CSRF токен
        $request->session()->regenerateToken();
        
        return redirect()->route('home')->with('success', 'Вы вышли из системы');
    }
}
