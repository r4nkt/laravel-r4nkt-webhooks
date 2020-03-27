<?php

namespace R4nkt\LaravelWebhooks\Tests;

use R4nkt\LaravelWebhooks\R4nktWebhookCall;

class DummyJob
{
    /** @var \R4nkt\LaravelWebhooks\R4nktWebhookCall */
    public $r4nktWebhookCall;

    public function __construct(R4nktWebhookCall $r4nktWebhookCall)
    {
        $this->r4nktWebhookCall = $r4nktWebhookCall;
    }

    public function handle()
    {
    }
}
