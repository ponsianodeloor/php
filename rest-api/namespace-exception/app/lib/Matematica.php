<?php
 namespace App\Lib;

 use Exception;
 class Matematica{
  public static function Sumar($a, $b){
   if (!is_int($a) || !is_int($b)) throw new Exception("Valores ingresados no son correctos");
    {
    return $a + $b;
   }
  }
 }
?>
