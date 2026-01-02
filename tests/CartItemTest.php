<?php

namespace VictorYoalli\Shoppingcart\Tests;

use VictorYoalli\Shoppingcart\CartItem;
use VictorYoalli\Shoppingcart\ShoppingcartServiceProvider;

class CartItemTest extends TestCase
{
    /**
     * Set the package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [ShoppingcartServiceProvider::class];
    }

    /** @test */
    public function it_can_be_cast_to_an_array()
    {
        $cartItem = new CartItem(1, 'Some item', 10.00, ['size' => 'XL', 'color' => 'red']);
        $cartItem->setQuantity(2);

        $array = $cartItem->toArray();

        $this->assertEquals(1, $array['id']);
        $this->assertEquals('Some item', $array['name']);
        $this->assertEquals(10.00, $array['price']);
        $this->assertEquals(2, $array['qty']);
        $this->assertEquals(['size' => 'XL', 'color' => 'red'], $array['options']);
        $this->assertEquals(0.0, $array['tax']);
        $this->assertEquals(20.00, $array['subtotal']);
        $this->assertNull($array['modelType']);
        $this->assertNotEmpty($array['rowId']);
    }

    /** @test */
    public function it_can_be_cast_to_json()
    {
        $cartItem = new CartItem(1, 'Some item', 10.00, ['size' => 'XL', 'color' => 'red']);
        $cartItem->setQuantity(2);

        $this->assertJson($cartItem->toJson());

        $decoded = json_decode($cartItem->toJson(), true);
        $this->assertEquals(1, $decoded['id']);
        $this->assertEquals('Some item', $decoded['name']);
        $this->assertEquals(2, $decoded['qty']);
        $this->assertEquals(10, $decoded['price']);
        $this->assertEquals(['size' => 'XL', 'color' => 'red'], $decoded['options']);
        $this->assertNotEmpty($decoded['rowId']);
    }
}
