<?php

namespace App\Services\Calculator;

use App\Enums\Operator;
use InvalidArgumentException;

class CalculatorService
{
    public int $precision = 8;
    private array $orderPriority
        = [
            Operator::ADD => 1,
            Operator::SUBTRACT => 1,
            Operator::MULTIPLY => 2,
            Operator::DIVIDE => 2,
        ];

    public function performCalculation(array $numbers, array $operators): int|float
    {
        // We'll perform the calculation by performing one operation at a time
        // This could be optimized to generate the order of operations by looking at the whole equation
        // once and then performing all the actions as ordered. However, it would require an absolutely
        // massive payload to have any noticeable performance improvements, so in this case we choose
        // simplicity and readability over that.

        // Check we're getting valid n operators and n+1 numbers here
        if (count($operators) !== (count($numbers) - 1)) {
            throw new InvalidArgumentException(
                sprintf("Invalid data supplied for calculation: %d numbers and %d operators",
                    count($numbers), count($operators)));
        }

        // We'll basically reduce the array into single final number by doing the operations one by one
        while (count($numbers) > 1) {
            // Find the first operator with the highest order priority
            $operatorIndex = $this->findHighestPriorityOperator($operators);
            $operator = $operators[$operatorIndex];

            // Fetch the numbers around that operator
            $a = $numbers[$operatorIndex];
            $b = $numbers[$operatorIndex + 1];

            // Perform the operation
            $operation = OperationFactory::make($operator);
            $result = $operation->perform($a, $b);

            // Reduce the arrays - remove the operator and replace the two numbers with the result
            array_splice($operators, $operatorIndex, 1);
            array_splice($numbers, $operatorIndex, 2, $result);
        }

        return round($numbers[0], $this->precision);
    }

    private function findHighestPriorityOperator(array $operators): int
    {
        // Map operators into their priorities
        $priorities = array_map(fn(string $operator) => $this->orderPriority[$operator] ?? 0, $operators);

        // Find the highest priority that currently exists
        $maxPriority = max($priorities);

        // And then find the first index that has that priority
        return array_search($maxPriority, $priorities, true);
    }
}