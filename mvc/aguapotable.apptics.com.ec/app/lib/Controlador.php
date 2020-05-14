<?php
 //Clase controlador principal
 //se encacarga de poder cargar los modelos y  las vistas

 class Controlador{
  //cargar modelo
  public function modelo($modelo){
   //carga modelo
   require_once '../app/models/'.$modelo.'.php';
   //instanciar el modelo
   return new $modelo();
  }

  //cargar vista
  public function vista($vista, $datos = []){
   if (file_exists('../app/views/'.$vista.'.php')) {
    require_once '../app/views/'.$vista.'.php';
   }else {
    //si la vista no existe
    die('La vista no existe');
   }
  }
 }
?>
