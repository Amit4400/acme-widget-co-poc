<?php

namespace App\Interfaces;

interface DeliveryRuleInterface
{
    public function calculate(float $basketTotal): float;
}
