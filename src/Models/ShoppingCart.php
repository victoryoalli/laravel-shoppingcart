<?php

namespace VictorYoalli\Shoppingcart\Models;

use Illuminate\Database\Eloquent\Model;

class Shoppingcart extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(config('shoppingcart.database.table'));
    }

    protected $guarded = [];

    protected $casts = ['content' => 'array' ];

    protected $primaryKey = 'identifier';
    protected $keyType = 'string';
    public $incrementing = false;
}
