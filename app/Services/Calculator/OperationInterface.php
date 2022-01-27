<?php

namespace App\Services\Calculator;

interface OperationInterface
{
    public function perform(int|float $a, int|float $b): float|int;
}