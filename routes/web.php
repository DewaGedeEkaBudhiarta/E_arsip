<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/arsip-pasi', function() {
    return view('arsip-pasi.index');
});
Route::get('/upload', function() {
    return view('uploud-file.index');
});
Route::get('/login', function() {
    return view('login-form.index');
});