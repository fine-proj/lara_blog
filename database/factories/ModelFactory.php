<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Corp\User::class, function (Faker $faker) {
    $name =  $faker->name;
    return [
        'name' => $name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('111'), // secret
        'remember_token' => str_random(10),
        'login' => $name,
    ];
});

$factory->define(Corp\Category::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,
        'alias' => $faker->unique()->word,
        'parent_id' => '0',
    ];
});

$factory->define(Corp\Filter::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,
        'alias' => $faker->unique()->word,
    ];
});

$factory->define(Corp\Slider::class, function (Faker $faker) {
    return [
        'title' =>  $faker->sentence(3),
        'desc' => $faker->paragraph(2, true),
        'img' => 'xx.jpg',
    ];
});

$factory->define(Corp\Menu::class, function (Faker $faker) {
    return [
        'title' =>  $faker->word,
        'path' => 'http://localhost',
        'parent' => '1',
    ];
});

$factory->define(Corp\Article::class, function (Faker $faker) {
     return [
        'title' =>  $faker->sentence(5),
        'text' => $faker->paragraph(7, true),
        'desc' =>  $faker->paragraph(2, true),
        'alias' =>  'article-' . $faker->numberBetween(10, 900),
        'img' =>  '{"mini":"003-55x55.jpg ","max":"003-816x282.jpg ","path":"0081-700x345.jpg"}',
        'user_id' =>  $faker->numberBetween(1, 5),
        'category_id' =>  $faker->numberBetween(1, 5),
        'keywords' =>  'Ключ N',
        'meta_desc' =>  'Краткое описание N',
        'created_at' => $faker->date('Y-m-d', 'now'),
        'updated_at' => $faker->date('Y-m-d', 'now'),
    ];
});

$factory->define(Corp\Comment::class, function (Faker $faker) {
    return [
        'text' =>  'OK ' . $faker->sentence(3),
        'name' => $faker->firstName.' '.$faker->lastName,
        'site' => $faker->url,
        'email' => $faker->unique()->safeEmail,
        'parent_id' => '0',
        'user_id' => null,
        'article_id' => $faker->numberBetween(1, 5),
    ];
});

$factory->define(Corp\Portfolio::class, function (Faker $faker) {
    return [
        'title' =>  $faker->sentence(2),
        'text' => $faker->paragraph(5, true),
        'customer' =>  $faker->sentence(2),
        'alias' =>  'project-' . $faker->numberBetween(10, 900),
        'img' =>  '{"mini":"0061-175x175.jpg","max":"0061-770x368.jpg","path":"0061.jpg"}',
        'filter_alias' =>  function()use($faker){
            return Corp\Filter::find( $faker->numberBetween(1, 3) )->alias;
        },
    ];
});