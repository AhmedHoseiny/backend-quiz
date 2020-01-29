<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\InsurancePayment;
use App\Models\Vehicle;
use Faker\Generator as Faker;

$factory->define(InsurancePayment::class, function (Faker $faker) {
    return [
        'vehicle_id' => function () {
            return factory(Vehicle::class)->create()->id;
        },
        'contract_date' => $faker->dateTime,
        'amount' => $faker->randomFloat(),
    ];
});
