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

/** @var \Illuminate\Database\Eloquent\Factory $factory */

//用户
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

//管理员用户
$factory->define(App\Models\AdminUser::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123'),
        'remember_token' => str_random(10),
    ];
});

//文章
$factory->define(App\Models\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraphs(50,true),
        'user_id' => $faker->numberBetween(1,200)
    ];
});

//评论
$factory->define(App\Models\Comment::class, function (Faker\Generator $faker) {
    return [
        'content' => $faker->sentence(2),
        'post_id' => $faker->numberBetween(1,204),
        'user_id' => $faker->numberBetween(2,200)
    ];
});

//赞
$factory->define(App\Models\Zan::class, function (Faker\Generator $faker) {
    return [
        'post_id' => $faker->numberBetween(1,204),
        'user_id' => $faker->numberBetween(2,200)
    ];
});

//粉丝、关注
$factory->define(App\Models\Fan::class, function (Faker\Generator $faker) {
    return [
        'fan_id' => $faker->numberBetween(2,204),
        'star_id' => $faker->numberBetween(2,200)
    ];
});

//专题
$factory->define(App\Models\Topic::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(1),
    ];
});

