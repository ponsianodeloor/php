<?php
 //cargamos librerias
 require_once 'config/config.php';


 /*
 require_once 'lib/Base.php';
 require_once 'lib/Controlador.php';
 require_once 'lib/Core.php';
 */
 
 //autoload php
 spl_autoload_register( function($nombreClase){
  require_once 'lib/'.$nombreClase.'.php';
 })
?>
