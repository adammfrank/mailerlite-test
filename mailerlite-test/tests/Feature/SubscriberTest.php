<?php

namespace Tests\Feature;

use App\Subscriber;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriberTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetSubscribers()
    {
        $subscribers = factory(Subscriber::class, 3)->create();

        $response = $this->getJson('/api/subscribers')
            ->assertStatus(200)
            ->assertJson($subscribers->toArray());

    }

    public function testUpdateSubscriberSuccess()
    {
        $subscribers = factory(Subscriber::class, 3)->create();

        $subscriber = $subscribers->get(0)->toArray();

        $response = $this->putJson('/api/subscribers/' . $subscriber['id'], $subscriber)
            ->assertStatus(200)
            ->assertJson($subscriber);

    }
    public function testUpdateSubscriberValidationFailure()
    {
        $subscribers = factory(Subscriber::class, 3)->create();

        $subscriber = $subscribers->get(0)->toArray();

        $response = $this->putJson('/api/subscribers/' . $subscriber['id'], ['name' => 'aba'])
            ->assertStatus(422);

    }
}
