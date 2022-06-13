<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Models\Entity as Entity;

$factory->define(Entity::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->name,
        'description' => $faker->text(200),
        'logo' => $faker->imageUrl()
    ];
});
