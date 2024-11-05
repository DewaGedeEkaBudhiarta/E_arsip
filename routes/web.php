<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\DB;

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home.index');
    });
        
    Route::get('/informasi', function () {
        return view('informasi-arsip.index');
    });

    Route::get('/arsip-pasi', [FileController::class, 'showUploadForm']);
    Route::get('/download/{id}', [FileController::class, 'download'])->name('files.download');
    
    Route::get('/pemindahan/table-active', function () {
        $files = DB::table('files')->where('status', 'active')->get();
        return view('pemindahan-arsip.index', ['partial' => 'table-active', 'files' => $files]);
    });    
    Route::get('/pemindahan/table-inactive', function () {
        $files = DB::table('files')->where('status', 'inactive')->get();
        return view('pemindahan-arsip.index', ['partial' => 'table-inactive', 'files' => $files]);
    });    
    Route::post('/files/{id}/update-status', [FileController::class, 'updateStatus'])->name('files.update-status');

    Route::get('/upload', function () {
        return view('uploud-file.index');
    });
    Route::post('/upload', [FileController::class, 'upload']);
    Route::delete('/delete/{id}', [FileController::class, 'delete'])->name('delete');
});


// Apply admin middleware to restrict access to the upload route
Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/give-permission', [UserController::class, 'givePermission'])->name('users.givePermission');
    Route::post('/users/{user}/remove-permission', [UserController::class, 'removePermission'])->name('users.removePermission');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);