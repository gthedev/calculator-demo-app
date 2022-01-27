<?php

namespace Tests\Unit\Services\Calculator;

use App\Enums\Operator;
use App\Services\Calculator\OperationFactory;
use App\Services\Calculator\Operations\Addition;
use App\Services\Calculator\Operations\Division;
use App\Services\Calculator\Operations\Multiplication;
use App\Services\Calculator\Operations\Subtraction;
use InvalidArgumentException;
use Tests\TestCase;

class OperationFactoryTest extends TestCase
{
    public function test_it_creates_correct_classes_for_supported_operators()
    {
        $this->assertEquals(Addition::class, get_class(OperationFactory::make(Operator::ADD)));
        $this->assertEquals(Subtraction::class, get_class(OperationFactory::make(Operator::SUBTRACT)));
        $this->assertEquals(Multiplication::class, get_class(OperationFactory::make(Operator::MULTIPLY)));
        $this->assertEquals(Division::class, get_class(OperationFactory::make(Operator::DIVIDE)));
    }

    public function unsupportedOperatorsProvider(): array
    {
        return [
            ['*'],
            ['^'],
            ['**'],
            ['()'],
            ['P'],
            ['0'],
        ];
    }

    /**
     * @dataProvider unsupportedOperatorsProvider
     */
    public function test_it_throws_an_exception_for_unsupported_operators(string $operator)
    {
        $this->expectException(InvalidArgumentException::class);
        OperationFactory::make($operator);
    }
}
