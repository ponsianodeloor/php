<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class TestController extends Controller
{
    public function suma(){
     $a = 5;
     $b = 6;
     $c = $a + $b;
     return "Se suma $a + $b = $c";
    }

    public function welcome(){
     $products = Product::all();
     return view('welcome', compact("products"));
    }
}
