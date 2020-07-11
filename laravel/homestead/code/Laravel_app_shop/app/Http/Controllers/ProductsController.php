<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class ProductsController extends Controller
{
    public function index(){
     $productos = Product::all();
     return view('products.index', compact("productos"));
    }
}
