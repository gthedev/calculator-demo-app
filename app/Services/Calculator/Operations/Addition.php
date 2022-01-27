<?php

namespace App\Services\Calculator\Operations;

use App\Services\Calculator\OperationInterface;

class Addition implements OperationInterface
{
    public function perform(float|int $a, float|int $b): float|int
    {
        return $a + $b;
    }
}