<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CalculatorPerformRequest;
use App\Services\Calculator\CalculatorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;

class CalculatorController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function perform(CalculatorPerformRequest $request, CalculatorService $service): JsonResponse
    {
        try {
            $result = $service->performCalculation($request->input('numbers'), $request->input('operators'));
        } catch (InvalidArgumentException $e) {
            throw ValidationException::withMessages(['input' => $e->getMessage()]);
        }

        return new JsonResponse([
            'result' => $result,
        ]);
    }
}
