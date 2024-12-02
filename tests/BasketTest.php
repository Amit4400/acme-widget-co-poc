<?php

use PHPUnit\Framework\TestCase;
use App\{Basket, Product, DeliveryRule, SpecialOffer};

class BasketTest extends TestCase
{

    public function testBasketCalculatesTotalCorrectly(): void
    {
        $catalogue = [
            new Product('R01', 'Red Widget', 32.95),
            new Product('G01', 'Green Widget', 24.95),
            new Product('B01', 'Blue Widget', 7.95)
        ];
        $deliveryRules = new DeliveryRule([
            50 => 4.95,
            90 => 2.95,
        ]);
        $offer = new SpecialOffer('R01', 0.5);
        $basket1 = new Basket($catalogue, $deliveryRules, [$offer]);
        $basket2 = new Basket($catalogue, $deliveryRules, [$offer]);
        $basket3 = new Basket($catalogue, $deliveryRules, [$offer]);
        $basket4 = new Basket($catalogue, $deliveryRules, [$offer]);
        $basket1->add('B01');
        $basket1->add('G01');

        $basket2->add('R01');
        $basket2->add('R01');

        $basket3->add('R01');
        $basket3->add('G01');

        $basket4->add('B01');
        $basket4->add('B01');
        $basket4->add('R01');
        $basket4->add('R01');
        $basket4->add('R01');

        $calculatedTotal1 = $basket1->total();
        $calculatedTotal2 = $basket2->total();
        $calculatedTotal3 = $basket3->total();
        $calculatedTotal4 = $basket4->total();
        
        $this->assertEquals(37.85, $calculatedTotal1);
        $this->assertEquals(54.37, $calculatedTotal2);
        $this->assertEquals(60.85, $calculatedTotal3);
        $this->assertEquals(98.27, $calculatedTotal4);
    }


}
