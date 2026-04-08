<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MainController;

// Главная страница через MainController (с JSON данными)
Route::get('/', [MainController::class, 'index'])->name('home');

// Страницы О нас и Контакты через PageController
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts');

// Страница галереи
Route::get('/gallery/{imageName}', [MainController::class, 'gallery'])->name('gallery');
