<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'price' => $faker->numberBetween(1000, 10000),
        'description' => $faker->paragraph,
        'active' => $faker->boolean
    ];
});