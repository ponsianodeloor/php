<?php
 class View
 {
  //las funciones en los modelos son protected
  function __construct(){

  }

  protected function obtenerVistasModel($views){ //las clases protected no se pueden instanciar
   //agregamos las vistas que tenemos en los contenidos menos a login
   //podemos ingresar esto en una base de datos
   $listaBlanca = [
    'admin', 'admin_list', 'admin-search', 'book',
    'book-config', 'book-info', 'catalog', 'category-list',
    'client', 'client-list', 'client-search', 'company',
    'company-list', 'home', 'my-acount',
    'my-data', 'my-account', 'provider', 'provider-list', 'search'
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
