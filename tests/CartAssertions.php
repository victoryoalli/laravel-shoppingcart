<?php

namespace VictorYoalli\Tests\Shoppingcart;

use PHPUnit\Framework\Assert as PHPUnit;
use VictorYoalli\Shoppingcart\Cart;

trait CartAssertions
{
    /**
     * Assert that the cart contains the given number of items.
     *
     * @param int|float                     $items
     * @param \VictorYoalli\Shoppingcart\Cart $cart
     */
    public function assertItemsInCart($items, Cart $cart)
    {
        $actual = $cart->count();

        PHPUnit::assertEquals($items, $cart->count(), "Expected the cart to contain {$items} items, but got {$actual}.");
    }

    /**
     * Assert that the cart contains the given number of rows.
     *
     * @param int                           $rows
     * @param \VictorYoalli\Shoppingcart\Cart $cart
     */
    public function assertRowsInCart($rows, Cart $cart)
    {
        $actual = $cart->content()->count();

        PHPUnit::assertCount($rows, $cart->content(), "Expected the cart to contain {$rows} rows, but got {$actual}.");
    }
}