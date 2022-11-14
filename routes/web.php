<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'homepage'])->name('pages.home');
Route::get('/over-mij', [PageController::class, 'about'])->name('pages.about');
