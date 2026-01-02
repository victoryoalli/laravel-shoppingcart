<?php

namespace VictorYoalli\Shoppingcart\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use VictorYoalli\Shoppingcart\ShoppingcartServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ShoppingcartServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function defineDatabaseMigrations()
    {
        $migration = include __DIR__.'/../database/migrations/create_shoppingcart_table.stub';
        $migration->up();
    }
}
