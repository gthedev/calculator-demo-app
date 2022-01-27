<?php

namespace Tests\Unit\Services\Calculator;

use App\Services\Calculator\CalculatorService;
use InvalidArgumentException;
use Tests\TestCase;

class CalculatorServiceTest extends TestCase
{
    private CalculatorService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = resolve(CalculatorService::class);
    }

    public function validEquationsDataProvider(): array
    {
        return [
            [[1, 1], ['+'], 2],
            [[1, 1], ['-'], 0],
            [[1, 1], ['x'], 1],
            [[1, 1], ['/'], 1],

            [[5, 3], ['+'], 8],
            [[-5, 3], ['+'], -2],
            [[55, -55], ['+'], 0],

            [[1, 5], ['-'], -4],
            [[30, 9], ['-'], 21],
            [[-15, 10], ['-'], -25],
            [[-15, -20], ['-'], 5],

            [[2, 3], ['x'], 6],
            [[5, -5], ['x'], -25],
            [[-10, -5], ['x'], 50],

            [[10, 5], ['/'], 2],
            [[4, -2], ['/'], -2],
            [[-20, 5], ['/'], -4],
            [[1, 4], ['/'], 0.25],
            [[10, 3], ['/'], 3.33333333],

            [[1, 1, 1], ['+', '+'], 3],
            [[1, 2, 3], ['-', '-'], -4],
            [[2, 2, 2], ['x', 'x'], 8],
            [[8, 2, 2], ['/', '/'], 2],

            [[3, 5, 4], ['+', '-'], 4],
            [[2, 10, 5, 5], ['x', '+', '-'], 20],
            [[10, 5, 3, 4], ['/', 'x', '+'], 10],

            [[3, 3, 3], ['+', 'x'], 12],
            [[3, 3, 3], ['x', '+'], 12],
            [[10, 1, 4], ['+', '/'], 10.25],

            [[10, 15, 3, 10, 4], ['+', 'x', '/', '-'], 10.5],
            [[0, 15, 45, 100, 20, 5], ['-', 'x', '+', '/', '-'], -675],
            [[50, 10, 5, 10, 1600, 4, 2, 1.25], ['x', 'x', '/', '-', '/', '/', 'x'], 0],
        ];
    }

    /**
     * @dataProvider validEquationsDataProvider
     */
    public function test_perform_calculation(array $numbers, array $operators, int|float $result)
    {
        $this->assertEquals($result, $this->service->performCalculation($numbers, $operators));
    }

    public function invalidPayloadProvider(): array
    {
        return [
            [[15, 10], ['-', '+', '+']],
            [[], []],
            [[15, 10, 10, 10, 10], ['+']],
            [[15, 10, 10, 10, 10], ['+']],
        ];
    }

    /**
     * @dataProvider invalidPayloadProvider
     */
    public function test_it_throws_an_exception_if_numbers_and_operators_count_doesnt_match_the_requirements(
        array $numbers,
        array $operators
    ) {
        $this->expectException(InvalidArgumentException::class);

        $this->service->performCalculation($numbers, $operators);
    }
}
