<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'homepage'])->name('pages.home');
Route::get('/tarieven', [PageController::class, 'pricing'])->name('pages.pricing');
Route::get('/over-mij', [PageController::class, 'about'])->name('pages.about');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
