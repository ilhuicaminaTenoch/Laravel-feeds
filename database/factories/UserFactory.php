<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Roles;
use Illuminate\Support\Str;
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


$factory->define(Roles::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'descripcion' => $faker->text(20),
        'condicion' => '1',
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'usuario' => $faker->name,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'condicion' => '1',
        'idrol' => factory('App\Roles')->create()->id,
        'remember_token' => Str::random(10),
    ];
});
