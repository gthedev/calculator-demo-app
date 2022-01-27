<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\View;

class CalculatorController extends Controller
{
    public function index(): ViewContract
    {
        return View::make('calculator');
    }
}
