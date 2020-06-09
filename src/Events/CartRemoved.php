<?php

namespace VictorYoalli\Shoppingcart\Events;

use Illuminate\Queue\SerializesModels;
use VictorYoalli\Shoppingcart\CartItem;

class CartRemoved
{
    use SerializesModels;
    public CartItem $cartItem;

    public function __construct(CartItem $cartItem)
    {
        $this->cartItem = $cartItem;
    }
}
