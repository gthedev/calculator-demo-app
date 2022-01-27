<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

class CalculatorTest extends TestCase
{
    public function test_it_can_show_calculator_page()
    {
        $this->get(route('calculator.index'))
            ->assertOk()
            ->assertViewIs('calculator');
    }
}
