<?php

use App\Http\Controllers\SolutionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SolutionController::class, 'index'])->name('solutions.index');
Route::post('/solve', [SolutionController::class, 'solve'])->name('solutions.solve');