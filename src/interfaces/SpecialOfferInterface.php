<?php

namespace App\Interfaces;

interface SpecialOfferInterface
{
    public function apply(array $products): array;
}
