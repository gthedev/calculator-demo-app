<?php

use App\Http\Controllers\Web\CalculatorController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/calculator');
Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator.index');
