<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
  return [
    'cat_id' => factory(Category::class),
    'name' => $faker->sentence(),
    'price' => $faker->numberBetween(200, 1000),
    'description' => $faker->sentence(2),
    'image' => $faker->image('public/images/products', 50, 50, null, false)
  ];
});
