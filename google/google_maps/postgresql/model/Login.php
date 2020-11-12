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

 protected function cerrarSesionModel($datos){
  if ($datos['CuentaUsuario'] != "" && $datos['token_usuario'] == $datos['token']) {
   $actualizar_bitacora = MainModel::actualizarBitacora($datos);
   if ($actualizar_bitacora->rowCount()==1) {
    session_unset();
    session_destroy();
    $respuesta = "true";
   }else{
     $respuesta = "false"." " . $datos['usuario_codigo_bitacora_sbp']." ". $datos['hora'];
   }
  }else{
   $respuesta = "false";
  }
  return $respuesta;
 }
}

?>
