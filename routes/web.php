<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/prompt_generator', [HomeController::class, 'prompt_generator'])->name('prompt_generator');
Route::get('/time_table', [HomeController::class, 'time_table'])->name('time_table');
Route::resource('contents', ContentController::class);
Route::resource('notes', NoteController::class);
Route::resource('posts', PostController::class);

Route::get('/image_styles', [HomeController::class, 'image_styles'])->name('image_styles');
Route::get('/image_prompt_knowledge', [HomeController::class, 'image_prompt_knowledge'])->name('image_prompt_knowledge');
Route::get('/image_prompt_ads', [HomeController::class, 'image_prompt_ads'])->name('image_prompt_ads');
