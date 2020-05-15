<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->sentence,
        "pickup_times" => $faker->sentence,
        "price" => 1000,
        "address" => "fukuoka",
        "image" => $faker->sentence,
        "state" => $faker->sentence,
        'user_id' => function(){
            return factory(App\User::class)->create()->id;
        },
    ];
});
