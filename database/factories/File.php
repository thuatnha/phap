<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'file_name' =>$faker->file_name,
        'date_time' => $faker->date_time,
        'user' => $faker->user
    ];
});
