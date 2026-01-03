<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/prompt_generator', [HomeController::class, 'prompt_generator'])->name('prompt_generator');
Route::get('/time_table', [HomeController::class, 'time_table'])->name('time_table');
Route::resource('contents', ContentController::class);
Route::resource('posts', PostController::class);
