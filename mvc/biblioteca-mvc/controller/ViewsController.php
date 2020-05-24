<?php
require_once "model/View.php";
 class ViewsController extends View
 {
  function __construct()
  {
   // code...
  }
  public function obtenerPlantillaController(){
   return require_once "views/plantilla.php";
  }
 }

?>
