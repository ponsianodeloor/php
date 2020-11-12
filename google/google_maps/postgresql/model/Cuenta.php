<?php
if ($peticion_ajax) {
 include_once "../core/MainModel.php";
}else{
 include_once "core/MainModel.php";
}


class Cuenta extends MainModel{

 function __construct(){

 }

 protected function consultarCuentaModel($CuentaCodigo){
  $query = MainModel::simpleQuery("SELECT * FROM cuenta WHERE CuentaCodigo = :CuentaCodigo");
  $query->bindParam(":CuentaCodigo", $CuentaCodigo);
  $query->execute();
  return $query;
 }

 protected function actualizarCuentaModel($datos){
  $query = MainModel::conectar()->prepare("UPDATE cuenta SET
                                            CuentaUsuario = :CuentaUsuario,
                                            CuentaEmail = :CuentaEmail,
                                            CuentaGenero = :CuentaGenero,
                                            CuentaPrivilegio = :CuentaPrivilegio,
                                            CuentaFoto = :CuentaFoto
                                            WHERE CuentaCodigo = :CuentaCodigo
                                          ");
 $query->bindParam(":CuentaUsuario", $datos['CuentaUsuario']);
 $query->bindParam(":CuentaEmail", $datos['CuentaEmail']);
 $query->bindParam(":CuentaGenero", $datos['CuentaGenero']);
 $query->bindParam(":CuentaPrivilegio", $datos['CuentaPrivilegio']);
 $query->bindParam(":CuentaFoto", $datos['CuentaFoto']);
 $query->bindParam(":CuentaCodigo", $datos['CuentaCodigo']);
 $query->execute();
 return $query;
 }
}

?>
