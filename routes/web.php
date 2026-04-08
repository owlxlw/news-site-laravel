<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;

// Главная страница
Route::get('/', [ArticleController::class, 'index'])->name('home');

// Страницы О нас и Контакты
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');

// Галерея (Задание 2)
Route::get('/gallery/{imageName}', [MainController::class, 'gallery'])->name('gallery');

// ========== Аутентификация (Задание 6) ==========
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ========== Новости (чтение - всем) ==========
Route::get('/news', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/news/{id}', [ArticleController::class, 'show'])->name('articles.show');

// ========== Создание новости (только модератор) ==========
Route::get('/add-news', [ArticleController::class, 'create'])->name('articles.create')->middleware('auth');
Route::post('/news', [ArticleController::class, 'store'])->name('articles.store')->middleware('auth');

// ========== Редактирование и удаление (только модератор) ==========
Route::get('/news/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit')->middleware('auth');
Route::put('/news/{id}', [ArticleController::class, 'update'])->name('articles.update')->middleware('auth');
Route::delete('/news/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('auth');
