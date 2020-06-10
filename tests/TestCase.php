<?php

namespace VictorYoalli\Shoppingcart\Tests;

use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use VictorYoalli\Shoppingcart\ShoppingcartServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        // $this->withFactories(__DIR__.'/database/factories');
    }

    protected function getPackageProviders($app)
    {
        return [
            ShoppingcartServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // $app['config']->set('database.default', 'sqlite');
        // $app['config']->set('database.connections.sqlite', [
        //     'driver' => 'sqlite',
        //     'database' => ':memory:',
        //     'prefix' => '',
        // ]);
        Schema::dropAllTables();

        include_once __DIR__.'/../database/migrations/create_shoppingcart_table.stub';
        (new \CreateShoppingcartTable())->up();
    }
}
