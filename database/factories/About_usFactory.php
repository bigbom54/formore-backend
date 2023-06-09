<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\About_us;
use Faker\Generator as Faker;

$factory->define(About_us::class, function (Faker $faker) {

    return [
        'title' => $faker->word,
        'content' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
