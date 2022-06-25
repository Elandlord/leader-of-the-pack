<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.under-construction');
//    return view('pages.homepage.index');
});

Route::get('/over-mij', function () {
    return view('pages.about.index');
});
