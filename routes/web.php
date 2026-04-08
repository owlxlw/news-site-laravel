<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');
Route::get('/gallery/{imageName}', [MainController::class, 'gallery'])->name('gallery');

// Задание 3: Регистрация пользователей
Route::get('/signin', [AuthController::class, 'create'])->name('signin');
Route::post('/signin', [AuthController::class, 'registration'])->name('signin.post');

// Задание 4: Новости
use App\Http\Controllers\ArticleController;

Route::get('/news', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/news/{id}', [ArticleController::class, 'show'])->name('articles.show');

// Перенаправление с главной на список новостей
Route::redirect('/', '/news');
