<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\HomeController;
use App\Models\ContentViewer;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('viewer.index', [ContentViewer::class, 'index'])->name('viewer.index');
Route::get('viewer.detail', [ContentViewer::class, 'detail'])->name('viewer.detail');
Route::resource('contents', ContentController::class);
