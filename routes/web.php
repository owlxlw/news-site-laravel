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

// Регистрация (Задание 3)
Route::get('/signin', [AuthController::class, 'create'])->name('signin');
Route::post('/signin', [AuthController::class, 'registration'])->name('signin.post');

// CRUD для новостей (Задание 5)
Route::get('/news', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/news/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/news', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/news/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/news/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/news/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Route::get('/news/{id}', [ArticleController::class, 'show'])->name('articles.show');
