<?php

namespace Tests\Unit\Services\Calculator\Operations;

use App\Services\Calculator\OperationInterface;
use App\Services\Calculator\Operations\Division;
use InvalidArgumentException;
use Tests\TestCase;

class DivisionTest extends TestCase
{
    private OperationInterface $operation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->operation = resolve(Division::class);
    }

    public function validResultsProvider(): array
    {
        return [
            [50, 10, 5],
            [2, 1, 2],
            [10, -5, -2],
            [-50, -10, 5],
            [10, 4, 2.5],
        ];
    }

    /**
     * @dataProvider validResultsProvider
     */
    public function test_it_performs_operation_correctly(float|int $a, float|int $b, float|int $result)
    {
        $this->assertEquals($result, $this->operation->perform($a, $b));
    }

    public function test_it_throws_an_exception_when_trying_to_divide_by_zero()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->operation->perform(50, 0);
    }
}
