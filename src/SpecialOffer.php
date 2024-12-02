<?php

namespace App;

use App\Interfaces\SpecialOfferInterface;

class SpecialOffer implements SpecialOfferInterface
{
    private string $productCode;
    private float $discount;

    public function __construct(string $productCode, float $discount)
    {
        $this->productCode = $productCode;
        $this->discount = $discount; // E.g., 0.5 for 50% off
    }

    public function apply(array $products): array
    {
        $productCount = 0;

        foreach ($products as &$product) {
            if ($product->code === $this->productCode) {
                $productCount++;
                if ($productCount % 2 === 0) {
                    $product->price *= $this->discount;
                    printf($product->price);
                }
            }
        }
        return $products;
    }
}
