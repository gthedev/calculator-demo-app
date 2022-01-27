<?php

namespace App\Services\Calculator;

use App\Enums\Operator;
use App\Services\Calculator\Operations\Addition;
use App\Services\Calculator\Operations\Division;
use App\Services\Calculator\Operations\Multiplication;
use App\Services\Calculator\Operations\Subtraction;
use InvalidArgumentException;

class OperationFactory
{
    private static array $classMap
        = [
            Operator::ADD => Addition::class,
            Operator::SUBTRACT => Subtraction::class,
            Operator::MULTIPLY => Multiplication::class,
            Operator::DIVIDE => Division::class,
        ];

    public static function make(string $operator): OperationInterface
    {
        if (!in_array($operator, self::supportedOperators())) {
            throw new InvalidArgumentException("Operator '{$operator}' not supported");
        }

        // Here we could local-cache the created objects
        // In this case it really doesn't matter, but
        // in certain cases you may want to cache the objects for performance
        // for expensive operations
        return resolve(self::$classMap[$operator]);
    }

    public static function supportedOperators(): array
    {
        return array_keys(self::$classMap);
    }
}