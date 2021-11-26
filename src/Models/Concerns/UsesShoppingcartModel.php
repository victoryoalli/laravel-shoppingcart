<?php

namespace VictorYoalli\Shoppingcart\Models\Concerns;

use Illuminate\Database\Eloquent\Model;

trait UsesShoppingcartModel
{
    public function getShoppingcartModel(): Model
    {
        $modelClass = config('shoppingcart.shoppingcart_model');

        return new $modelClass();
    }
}
