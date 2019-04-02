<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Blog::class, function (Faker $faker) {
    return [
        "title" => $faker->text(255),
        "content" => $faker->text,
        'blog_thumbnail' => $faker->imageUrl(),
        'age_limit' => $faker->randomElement([0, 5, 9, 13, 18]),
        'gender_limit' => $faker->randomElement([0, 1, 2]),
        'is_deleted' => $faker->randomElement([0, 1])
    ];
});
