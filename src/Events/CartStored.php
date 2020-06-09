<?php

namespace VictorYoalli\Shoppingcart\Events;

use Illuminate\Queue\SerializesModels;

class CartStored
{
    use SerializesModels;

    public function __construct()
    {
    }
}
