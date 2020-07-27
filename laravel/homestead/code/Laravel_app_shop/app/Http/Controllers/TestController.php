<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
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

    public function guardar(){
     $entrada = $request->all();
     if ($archivo = $request->file('imagen')) {
      $nombre = $archivo->getClientOriginalName();
      $archivo->move('img', $nombre);
      $entrada['imagen']=$nombre;
     }
     Product::create($entrada);
     return redirect( "/admin/products");
    }
}
