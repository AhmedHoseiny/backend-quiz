<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Service;
use App\Models\Vehicle;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'vehicle_id' => function () {
            return factory(Vehicle::class)->create()->id;
        },
        'created_at' => $faker->dateTime,
        'total' => $faker->randomFloat(),
    ];
});
