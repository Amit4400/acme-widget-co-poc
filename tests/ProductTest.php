<?php

use PHPUnit\Framework\TestCase;
use App\Product;

class ProductTest extends TestCase
{
    public function testProductInitialization(): void
    {
        $product = new Product('R01', 'Red Widget', 32.95);

        $this->assertEquals('R01', $product->code);
        $this->assertEquals('Red Widget', $product->name);
        $this->assertEquals(32.95, $product->price);
    }
}
