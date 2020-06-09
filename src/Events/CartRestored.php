<?php

namespace VictorYoalli\Shoppingcart\Events;

use Illuminate\Queue\SerializesModels;

class CartRestored
{
    use SerializesModels;

    public function __construct()
    {
    }
}
