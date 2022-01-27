<?php

namespace App\Http\Requests\API;

use App\Services\Calculator\OperationFactory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalculatorPerformRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'numbers' => ['required', 'array', 'min:1'],
            'numbers.*' => ['integer'],
            'operators' => ['array', 'size:'.count($this->input('numbers')) - 1],
            'operators.*' => ['string', Rule::in(OperationFactory::supportedOperators())],
        ];
    }
}
