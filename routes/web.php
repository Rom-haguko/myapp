<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/form', [PageController::class, 'form'])->name('form');
Route::post('/form', [PageController::class, 'submit'])->name('form.submit');
Route::get('/list', [PageController::class, 'list'])->name('list');
