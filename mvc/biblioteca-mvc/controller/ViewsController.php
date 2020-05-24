<?php
require_once "model/View.php";
 class ViewsController extends View
 {
  function __construct(){}

  public function obtenerPlantillaController(){
   return require_once "views/plantilla.php";
  }

  public function obtenerVistasController(){
   if (isset($_GET['views'])) { //hace referencia en el archivo .htaccess que se encuentra en la raiz del sitio
    $ruta = explode("/", $_GET['views']); //fraccionamos la ruta
    //$respuesta = self::obtenerVistasModel($ruta[0]); // es lo mismo que instanciar la misma clase
    $respuesta = View::obtenerVistasModel($ruta[0]); // http://localhost/mvc/admin/1 -> se selecciona admin como controlador
   }else {
    $respuesta = "login"; //vamos a loggear al usuario
   }
   return $respuesta;
  }
 }

?>
