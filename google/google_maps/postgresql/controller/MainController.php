<?php
 if ($peticion_ajax) {
  include_once "../core/MainModel.php";
 }else{
  include_once "core/MainModel.php";
 }

 class MainController extends MainModel{

  function __construct(){
   // code...
  }

 } //class MainControllerController

?>
