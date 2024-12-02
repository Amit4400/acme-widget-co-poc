<?php

namespace App;

use App\Interfaces\DeliveryRuleInterface;

class Basket
{
    private array $products = [];
    private DeliveryRuleInterface $deliveryRule;
    private array $specialOffers = [];

    public function __construct(
        private array $catalogue,
        DeliveryRuleInterface $deliveryRule,
        array $specialOffers = []
    ) {
        $this->deliveryRule = $deliveryRule;
        $this->specialOffers = $specialOffers;
    }

    public function add(string $productCode): void
    {
        foreach ($this->catalogue as $product) {
            if ($product->code === $productCode) {
                $this->products[] = clone $product; // Avoid mutation of original product
                return;
            }
        }
        throw new \InvalidArgumentException("Product not found: $productCode");
    }

    public function total(): float
    {
        $products = $this->products;

        foreach ($this->specialOffers as $offer) {
            $products = $offer->apply($products);
        }

        $productTotal = array_sum(array_map(fn($p) => $p->price, $products));
        $deliveryCost = $this->deliveryRule->calculate($productTotal);
        
        $total = $productTotal + $deliveryCost;
        return floatval(sprintf('%.2f', floor(($total) * 100) / 100));
    }
}
