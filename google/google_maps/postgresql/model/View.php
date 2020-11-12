<?php
 class View
 {
  /**
   * [__construct description las funciones en los modelos son protected]
   */
  function __construct(){

  }
  /**
   * [obtenerVistasModel description
   * las clases protected no se pueden instanciar
   * ]
   * @param  [type string] $views [description se obtiene desde la url]
   * @return [type archivo php]   [description retorna la vista]
   */
  protected function obtenerVistasModel($views){
   /**
    * [$listaBlanca description
    * agregamos las vistas que tenemos en los contenidos menos a login]
    * podemos ingresar esto en una base de datos
    * @var array
    */
   $listaBlanca = [
    'admin', 'admin_list', 'admin-search', 'book',
    'book-config', 'book-info', 'catalog', 'category-list',
    'client', 'client-list', 'client-search', 'client-loans','company',
    'company-list', 'home', 'my-acount',
    'my-data', 'my-account', 'provider', 'provider-list', 'producto', 'producto-list', 'producto-edit', 'search'
   ];

   if (in_array($views, $listaBlanca)) {
    if (is_file('views/contenidos/'.$views."_view.php")) {
     $contenido = 'views/contenidos/'.$views."_view.php";
    }else {
     $contenido = "login";
    }
   }elseif($views=="login") {
    $contenido = "login";
   }elseif ($views == "index") {
    $contenido = "login";
   }else {
    $contenido = "404";
   }
   return $contenido;
  }
 }

?>
