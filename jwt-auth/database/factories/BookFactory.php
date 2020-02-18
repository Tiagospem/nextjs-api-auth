<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Book;
use App\User;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->sentence(2),
        'user_id' => function (){
            return factory(User::class)->create()->id;
        }
    ];
});
