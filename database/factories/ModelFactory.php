<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Article::class, function ($faker) {
    return [
        'title' => $faker->word,
        'body' => $faker->sentence,
        'keyword'=>$faker->sentence,
        'user_id'=>'1',
    ];
});

$factory->define(App\Comment::class, function ($faker) {
    return [
        'title'=>$faker->word,
        'body'=>$faker->sentence,
        'user_id'=>'1',
        'article_id'=>rand(1,20),
    ];
});