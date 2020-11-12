<?php
require_once "model/View.php";
 class ViewsController extends View
 {
  function __construct(){}

  public function obtenerPlantillaController(){
   return require_once "views/plantilla.php";
  }

  public function obtenerVistasController(){
   /**
    * [if hace referencia en el archivo .htaccess que se encuentra en la raiz del sitio]
    * @var [type string]
    */
   if (isset($_GET['views'])) {
    /**
     * [$ruta //fraccionamos la ruta]
     * @var [type string]
     */
    $ruta = explode("/", $_GET['views']);
    //$respuesta = self::obtenerVistasModel($ruta[0]); // es lo mismo que instanciar la misma clase
    /**
     * [$respuesta description
     * http://sitio_web.com/home/
     * ruta[0] = home/,
     * http://sitio_web.com/admin/1
     * ruta[0] = admin/1
     * @var [type]
     */
    $respuesta = View::obtenerVistasModel($ruta[0]);
   }else {
    $respuesta = "login"; //vamos a loggear al usuario
   }
   return $respuesta;
  }
 }

?>
