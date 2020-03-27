<?php

namespace R4nkt\LaravelWebhooks\Tests;

use R4nkt\LaravelWebhooks\R4nktWebhooksServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        config(['r4nkt-webhooks.signing_secret' => 'test_signing_secret']);
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            R4nktWebhooksServiceProvider::class,
        ];
    }

    protected function determineR4nktSignature(array $payload): string
    {
        $secret = config('r4nkt-webhooks.signing_secret');

        return hash_hmac('sha256', json_encode($payload), $secret);
    }
}
