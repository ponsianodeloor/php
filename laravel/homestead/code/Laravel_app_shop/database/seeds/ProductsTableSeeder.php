<?php

use Illuminate\Database\Seeder;
use App\Category;
use App\Product;
use App\ProductImage;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //model Factories
        factory(Category::class, 5)->create();
        factory(Product::class, 100)->create();
        factory(ProductImage::class, 200)->create();

        //factory(Product::class, 100)->create(); //a mas de crearlo lo guarda en la base de datos
        //factory(Product::class)->make(); // crea el objeto
    }
}
