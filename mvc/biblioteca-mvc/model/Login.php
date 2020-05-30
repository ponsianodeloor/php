<?php
if ($peticion_ajax) {
 include_once "../core/MainModel.php";
}else{
 include_once "core/MainModel.php";
}

class Login extends MainModel{

 function __construct(){
 }

 protected function iniciarSesionModel($datos){
   $query = MainModel::simpleQuery("SELECT * FROM cuenta
                         WHERE CuentaUsuario = :CuentaUsuario
                         AND CuentaClave = :CuentaClave
                         AND CuentaEstado = 'Activo'");
   $query->bindParam(":CuentaUsuario", $datos['CuentaUsuario']);
   $query->bindParam(":CuentaClave", $datos['CuentaClave']);
   $query->execute();
   return $query;
 }
}

?>
