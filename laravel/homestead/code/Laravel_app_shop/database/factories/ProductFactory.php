<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
     'nombre'=>$faker->word,
     'descripcion'=>$faker->sentence(10),
     'imagen'=>$faker->imageUrl(250,250),
     'descripcion_larga'=>$faker->text,
     'precio'=>$faker->randomFloat(2, 5, 150),
     'precio_compra'=>$faker->randomFloat(2, 5, 150),
     'precio_venta_unitario'=>$faker->randomFloat(2, 5, 150),
     'precio_venta_al_mayor'=>$faker->randomFloat(2, 5, 150),

     'category_id'=>$faker->numberBetween(1,5)
    ];
});
