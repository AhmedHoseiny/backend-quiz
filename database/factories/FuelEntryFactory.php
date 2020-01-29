<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\FuelEntry;
use App\Models\Vehicle;
use Faker\Generator as Faker;

$factory->define(FuelEntry::class, function (Faker $faker) {
    return [
        'vehicle_id' => function () {
          return factory(Vehicle::class)->create()->id;
        },
        'entry_date' => $faker->dateTime,
        'cost' => $faker->randomFloat(),
    ];
});
