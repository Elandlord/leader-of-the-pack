<?php

use App\Models\Dog;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $dogs = Dog::all();

    return view('pages.homepage.index', [
        'dogs' => $dogs
    ]);
});

Route::get('/over-mij', function () {
    return view('pages.about.index');
});
