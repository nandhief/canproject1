<?php

use Faker\Generator as Faker;

$factory->define(App\Career::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'posisi' => collect(['Office Boy', 'Security', 'Teller', 'HRD', 'HRGA'])->random(),
        'description' => $faker->paragraph(5),
    ];
});

$factory->define(App\Layanan::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'short_desc' => $faker->paragraph,
        'description' => $faker->paragraph(rand(20, 50)),
        'status' => rand(0,1),
    ];
});

$factory->define(App\Promo::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'short_desc' => $faker->paragraph,
        'description' => $faker->paragraph(rand(20, 50)),
        'status' => rand(0,1),
    ];
});

$factory->define(App\Lelang::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'short_desc' => $faker->paragraph,
        'description' => $faker->paragraph(rand(20, 50)),
        'status' => rand(0,1),
    ];
});

$factory->define(App\News::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'embeded' => 'HU8_GMXoIcI',
        'short_desc' => $faker->paragraph,
        'description' => $faker->paragraph(rand(20, 50)),
        'status' => rand(0,1),
    ];
});
