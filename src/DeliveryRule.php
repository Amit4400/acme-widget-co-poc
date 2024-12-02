<?php

namespace App;

use App\Interfaces\DeliveryRuleInterface;

class DeliveryRule implements DeliveryRuleInterface
{
    private array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules; // Format: [upperLimit => cost]
    }

    public function calculate(float $basketTotal): float
    {
        foreach ($this->rules as $limit => $cost) {
            if ($basketTotal > 0 && $basketTotal < $limit) {
                return $cost;
            }
        }
        return 0.0; // Free delivery for highest tier
    }
}
