<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Curso;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Curso::class, function (Faker $faker) {

    $name=$faker->sentence();
    return [
        'nombre'=>$name,
        'slug'=>Str::slug($name,'-'),//hola-mundo
        'descripcion'=>$faker->paragraph(),
        'categoria'=>$faker->randomElement(['Desarrollo Web','Diseño Web'])
    ];
});
