<?php

namespace R4nkt\LaravelWebhooks;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use R4nkt\LaravelWebhooks\Exceptions\WebhookFailed;
use R4nkt\LaravelWebhooks\Middleware\VerifySignature;

class R4nktWebhooksController extends Controller
{
    public function __construct()
    {
        $this->middleware(VerifySignature::class);
    }

    public function __invoke(Request $request)
    {
        $eventPayload = json_decode($request->getContent(), true);

        if (! isset($eventPayload['type'])) {
            throw WebhookFailed::missingType($request);
        }

        $type = $eventPayload['type'];

        $r4nktWebhookCall = new R4nktWebhookCall($eventPayload);

        event("r4nkt-webhooks::{$type}", $r4nktWebhookCall);

        $jobClass = $this->determineJobClass($type);

        if ($jobClass === '') {
            return;
        }

        if (! class_exists($jobClass)) {
            throw WebhookFailed::jobClassDoesNotExist($jobClass, $r4nktWebhookCall);
        }

        dispatch(new $jobClass($r4nktWebhookCall));
    }

    protected function determineJobClass(string $type): string
    {
        return config("r4nkt-webhooks.jobs.{$type}", '');
    }
}
