<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/viewer', [ContentController::class, 'viewer'])->name('viewer');
Route::resource('contents', ContentController::class);
