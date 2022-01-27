<?php

namespace Tests\Unit\Services\Calculator\Operations;

use App\Services\Calculator\OperationInterface;
use App\Services\Calculator\Operations\Subtraction;
use Tests\TestCase;

class SubtractionTest extends TestCase
{
    private OperationInterface $operation;

    public function validResultsProvider(): array
    {
        return [
            [10, 10, 0],
            [50, 49, 1],
            [85, 15, 70],
            [-100, 50, -150],
            [8, 40, -32],
            [-10, -54, 44],
            [15.5, 4.5, 11],
            [9, 3.3, 5.7],
        ];
    }

    /**
     * @dataProvider validResultsProvider
     */
    public function test_it_performs_operation_correctly(float|int $a, float|int $b, float|int $result)
    {
        $this->assertEquals($result, $this->operation->perform($a, $b));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->operation = resolve(Subtraction::class);
    }
}
