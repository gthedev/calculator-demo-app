<?php

namespace App\Services\Calculator\Operations;

use App\Services\Calculator\OperationInterface;
use InvalidArgumentException;

class Division implements OperationInterface
{
    public function perform(float|int $a, float|int $b): float|int
    {
        if ($b == 0) {
            throw new InvalidArgumentException("Division by zero impossible");
        }

        return $a / $b;
    }
}