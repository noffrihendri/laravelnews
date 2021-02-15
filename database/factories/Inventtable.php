<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Minventtable;
use Faker\Generator as Faker;

$factory->define(Minventtable::class, function (Faker $faker) {
    return [
        'itemid' => $faker->uniqid()->itemid,
        'name' => $faker->name,
        'description' => $faker->description,
        'brand' => $faker->brand,
        'sub_brand' => $faker->brand,
        'height' => $faker->brand,
        'widht' => $faker->brand,
        'created_by' => $faker->brand,
        'created_at' =>  now(),
        'update_at' => now()
    ];
});
