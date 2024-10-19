<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

Route::get('/arsip-pasi', function() {
    return view('arsip-pasi.index');
});
Route::get('/uploud', function() {
    return view('uploud-file.index');
});