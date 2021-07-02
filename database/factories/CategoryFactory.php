<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
  return [
    'name' => $faker->sentence(),
    'about' => $faker->paragraph(),
    'image' => $faker->image('public/images/categories', 70, 70, null, false)
  ];
});
