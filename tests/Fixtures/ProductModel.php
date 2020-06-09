<?php

namespace VictorYoalli\Shoppingcart\Tests\Fixtures;

class ProductModel
{
    public $someValue = 'Some value';

    public function find($id)
    {
        return $this;
    }
}
