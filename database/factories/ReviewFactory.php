<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        //
        "title"=>$faker->sentence,
        "body" => $faker->paragraphs(3),
        "entity_id" => \App\Models\Entity::all()->random()->id,
    ];
});
