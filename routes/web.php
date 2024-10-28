<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\AdminMiddleware;


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home.index');
    });
    Route::get('/profile', function () {
        return view('profile.index');
    });
    Route::get('/arsip-pasi', function () {
        return view('arsip-pasi.index');
    });
    Route::get('/pemindahan', function () {
        return view('pemindahan-arsip.index');
    });
    Route::get('/informasi', function () {
        return view('informasi-arsip.index');
    });
});


// Apply admin middleware to restrict access to the upload route
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/upload', function () {
        return view('uploud-file.index');
    });
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
