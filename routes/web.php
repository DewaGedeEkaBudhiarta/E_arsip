<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});

//tanya dion knp index ku gk bisa jalan
//tanya dion knp list-file nya gk bisa masuk ke layout app.blade.php
