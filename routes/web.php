<?php

use App\Http\Controllers\ContentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ContentController::class, 'index']);
Route::post('/generate', [ContentController::class, 'generate'])->name('generate');
