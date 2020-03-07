<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subscriber;
use Faker\Generator as Faker;

$factory->define(Subscriber::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email_address' => $faker->unique()->safeEmail,
        'state' => 1,
    ];
});

$factory->afterCreating(Subscriber::class, function (Subscriber $subscriber, Faker $faker) {
    $subscriber->fields()->save(factory(App\Field::class)->make());
});
