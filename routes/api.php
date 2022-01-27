<?php

use App\Http\Controllers\API\CalculatorController;
use Illuminate\Support\Facades\Route;

Route::post('/calculate', [CalculatorController::class, 'perform']);
