<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Метод create - отправляет страницу с формой регистрации
    public function create()
    {
        return view('auth.signin');
    }
    
    // Метод registration - обрабатывает данные формы
    public function registration(Request $request)
    {
        // Валидация входных данных (без проверки unique:users)
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:50',
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'name.min' => 'Имя должно содержать не менее 2 символов',
            'email.required' => 'Поле "Email" обязательно для заполнения',
            'email.email' => 'Введите корректный email адрес',
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.min' => 'Пароль должен содержать не менее 6 символов',
            'password.confirmed' => 'Подтверждение пароля не совпадает',
        ]);
        
        // Если валидация не прошла - возвращаем ошибки в JSON
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        
        // Возвращаем JSON-ответ с успешной регистрацией
        return response()->json([
            'success' => true,
            'message' => 'Регистрация прошла успешно!',
            'data' => [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]
        ], 201);
    }
}
