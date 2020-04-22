<?php
 /**
  *
  */
 class Articulos extends Controlador{
  function __construct(){
   //echo "Controlador articulos cargado";
   $this->articuloModelo = $this->modelo("Articulo");
  }
 }


?>
