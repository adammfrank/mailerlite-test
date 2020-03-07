<?php

namespace Tests\Feature;

use App\Field;
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

    public function testStoreSubscriberSuccess()
    {
        $subscribers = factory(Subscriber::class, 1)->make();

        $subscriber = $subscribers->get(0)->toArray();

        $response = $this->postJson('/api/subscribers/', $subscriber)
            ->assertStatus(200)
            ->assertJson($subscriber);

    }
    public function testStoreSubscriberValidationFailure()
    {
        $response = $this->postJson('/api/subscribers/', ['name' => 'aba'])
            ->assertStatus(422);

    }

    public function testDestroySubscriberSuccess()
    {
        $subscribers = factory(Subscriber::class, 1)->create();
        $subscriber = $subscribers->get(0)->toArray();

        $existing_fields = Field::count();

        $this->assertEquals(1, $existing_fields);

        $response = $this->deleteJson('/api/subscribers/' . $subscriber['id'], $subscriber)
            ->assertStatus(200);

        $existing_fields = Field::count();
        $existing_subscribers = Subscriber::count();

        $this->assertEquals(0, $existing_fields);
        $this->assertEquals(0, $existing_subscribers);

    }

    public function testDestroySubscriberValidationFailure()
    {
        $subscribers = factory(Subscriber::class, 1)->create();
        $subscriber = $subscribers->get(0)->toArray();
        $response = $this->deleteJson('/api/subscribers/9', $subscriber)
            ->assertStatus(422);

        $existing_fields = Field::count();
        $existing_subscribers = Subscriber::count();

        $this->assertEquals(1, $existing_fields);
        $this->assertEquals(1, $existing_subscribers);
    }
}
