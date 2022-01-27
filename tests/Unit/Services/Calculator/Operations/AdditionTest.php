<?php

namespace Tests\Unit\Services\Calculator\Operations;

use App\Services\Calculator\OperationInterface;
use App\Services\Calculator\Operations\Addition;
use Tests\TestCase;

class AdditionTest extends TestCase
{
    private OperationInterface $operation;

    public function validResultsProvider(): array
    {
        return [
            [10, 10, 20],
            [5, 12, 17],
            [1, 5000, 5001],
            [-15, 10, -5],
            [-10, -22, -32],
            [30, -15, 15],
            [10.5, 2, 12.5],
            [9.5, 2.5, 12],
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

        $this->operation = resolve(Addition::class);
    }
}
