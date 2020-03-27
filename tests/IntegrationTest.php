<?php

namespace R4nkt\LaravelWebhooks\Tests;

use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use R4nkt\LaravelWebhooks\R4nktWebhookCall;

class IntegrationTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Event::fake();

        Bus::fake();

        Route::r4nktWebhooks('r4nkt-webhooks');

        config(['r4nkt-webhooks.jobs' => ['badgeEarned' => DummyJob::class]]);
    }

    /** @test */
    public function it_can_handle_a_valid_request()
    {
        $this->withoutExceptionHandling();

        $payload = $this->getTestPayload();

        $headers = ['R4nkt-Signature' => $this->determineR4nktSignature($payload)];

        $this
            ->postJson('r4nkt-webhooks', $payload, $headers)
            ->assertSuccessful();

        Event::assertDispatched('r4nkt-webhooks::badgeEarned', function ($event, $eventPayload) {
            if (! $eventPayload instanceof R4nktWebhookCall) {
                return false;
            }

            if ($eventPayload->type() != 'badgeEarned') {
                return false;
            }

            if ($eventPayload->dateTime() != '20160101120000') {
                return false;
            }

            if ($eventPayload->site()['id'] != 'site1') {
                return false;
            }

            if ($eventPayload->run()['id'] != 'run1') {
                return false;
            }

            return true;
        });

        Bus::assertDispatched(DummyJob::class, function (DummyJob $job) {
            return $job->r4nktWebhookCall->type() === 'badgeEarned';
        });
    }

    /** @test */
    public function no_jobs_or_events_will_be_fired_if_a_request_has_an_invalid_signature()
    {
        $payload = $this->getTestPayload();

        $headers = ['Stripe-Signature' => 'invalid_signature'];

        $this
            ->postJson('r4nkt-webhooks', $payload, $headers)
            ->assertStatus(400);

        Event::assertNotDispatched('stripe-webhooks::my.type');

        Bus::assertNotDispatched(DummyJob::class);
    }

    /**
     * @return array
     */
    public function getTestPayload(): array
    {
        $payload = [
            'type' => 'badgeEarned',
            'dateTime' => '20160101120000',
            'site' => ['id' => 'site1'],
            'run' => ['id' => 'run1'],
        ];

        return $payload;
    }
}
