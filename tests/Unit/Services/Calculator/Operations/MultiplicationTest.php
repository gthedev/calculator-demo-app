<?php

namespace Tests\Unit\Services\Calculator\Operations;

use App\Services\Calculator\OperationInterface;
use App\Services\Calculator\Operations\Multiplication;
use Tests\TestCase;

class MultiplicationTest extends TestCase
{
    private OperationInterface $operation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->operation = resolve(Multiplication::class);
    }

    public function validResultsProvider(): array
    {
        return [
            [10, 10, 100],
            [5, 2, 10],
            [9, 5, 45],
            [2, 2, 4],
            [2.5, 4, 10],
            [1.5, 5, 7.5],
        ];
    }

    /**
     * @dataProvider validResultsProvider
     */
    public function test_it_performs_operation_correctly(float|int $a, float|int $b, float|int $result)
    {
        $this->assertEquals($result, $this->operation->perform($a, $b));
    }
}
