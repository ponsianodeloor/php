<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{

    public function run()
    {
        //model Factories
        $categories = factory(App\Category::class, 5)
           ->create()
           ->each(function ($category) {
            $products = $category->product()->createMany(
             factory(App\Product::class, 20)->make()->toArray()
             );

            $products->each(function ($product) {
             $productImages = $product->productImage()->createMany(
              factory(App\ProductImage::class, 5)->make()->toArray()
              );
            });
           });

           /*factory(Category::class, 5)->create();
           factory(Product::class, 100)->create();
           factory(ProductImage::class, 200)->create();*/

           //factory(Product::class, 100)->create(); //a mas de crearlo lo guarda en la base de datos
           //factory(Product::class)->make(); // crea el objeto

           //factory con relaciones laravel

           /*$users = factory(App\User::class, 3)
              ->create()
              ->each(function ($user) {
                   $user->posts()->save(factory(App\Post::class)->make());
               });

           // You may use the createMany method to create multiple related models:

           $user->posts()->createMany(
            factory(App\Post::class, 3)->make()->toArray()
           );
           */    
    }
}
