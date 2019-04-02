<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'password' => Hash::make('manhtien'),
        'name' => $faker->text(255),
        'age' => $faker->numberBetween(1,100),
        'gender' => $faker->randomElement([0,1]),
        'user_thumbnail' => $faker->imageUrl(),
        'is_deleted' => $faker->randomElement([0,1])
    ];
});
