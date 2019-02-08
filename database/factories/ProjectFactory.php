<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title'=>$this->faker->sentence(3),
        'description'=>$this->faker->paragraph,
        'owner_id'=>factory('App\User')
    ];
});
