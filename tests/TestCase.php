<?php

namespace lboulanger\LaravelDevelopmentHelpers\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use lboulanger\LaravelDevelopmentHelpers\Actions\LaravelDevelopmentHelpersServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'lboulanger\\LaravelDevelopmentHelpers\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelDevelopmentHelpersServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-development-helpers_table.php.stub';
        $migration->up();
        */
    }
}
