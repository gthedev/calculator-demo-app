<?php

namespace Tests\Feature\API;

use Tests\TestCase;

class CalculatorTest extends TestCase
{
    public function validDataProvider(): array
    {
        return [
            [[50, 10, 5000, 10, 5], ['x', '-', '/', '+'], 5],
            [[1, 2, 3, 4, 3, 0], ['+', '+', 'x', '/', 'x'], 3],
            [[5, 3], ['/'], 1.66666667],
            [[100], [], 100],
        ];
    }

    /**
     * @dataProvider validDataProvider
     */
    public function test_it_can_perform_a_calculation(array $numbers, array $operators, int|float $expectedResult)
    {
        $this->postJson('/api/calculate', [
            'numbers' => $numbers,
            'operators' => $operators,
        ])
            ->assertOk()
            ->assertJson([
                'result' => $expectedResult,
            ]);
    }


    public function invalidDataProvider(): array
    {
        return [
            [[], []],
            [[], ['-', '+']],
            [[1, 2], ['-', '+']],
            [[1, 2, 3], ['-', '+', 'x', 'x', 'x']],
            [[5, 10, 0], ['+', '/']],
            [['a', 'b'], ['+']],
            [[5, 4], ['*']],
            [[5, 4], ['^']],
            [[5, 4, 3, 2], ['+', '-', '&']],
        ];
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function test_it_will_return_validation_errors_for_invalid_payloads(array $numbers, array $operators)
    {
        $this->postJson('/api/calculate', [
            'numbers' => $numbers,
            'operators' => $operators,
        ])
            ->assertStatus(422);
    }

    public function test_it_will_handle_division_by_zero_gracefully()
    {
        $this->postJson('/api/calculate', [
            'numbers' => [10, 5, 0],
            'operators' => ['x', '/'],
        ])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['input' => 'Division by zero impossible']);
    }
}
