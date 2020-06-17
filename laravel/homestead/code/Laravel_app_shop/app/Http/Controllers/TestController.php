<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function suma(){
     $a = 5;
     $b = 6;
     $c = $a + $b;
     return "Se suma $a + $b = $c";
    }
}
