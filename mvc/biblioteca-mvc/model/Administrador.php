<?php
if ($peticion_ajax) {
 include_once "../core/MainModel.php";
}else{
 include_once "core/MainModel.php";
}

class Administrador extends MainModel{

 function __construct(){

 }

 protected function agregarAdministradorModel($datos){
  $query = MainModel::conectar()->prepare("INSERT INTO admin(
                                            AdminDNI,
                                            AdminNombre,
                                            AdminApellido,
                                            AdminTelefono,
                                            AdminDireccion,
                                            CuentaCodigo
                                           )
                                           VALUES(
                                            :AdminDNI,
                                            :AdminNombre,
                                            :AdminApellido,
                                            :AdminTelefono,
                                            :AdminDireccion,
                                            :CuentaCodigo
                                           )
                                          ");
 $query->bindParam(":AdminDNI", $datos['AdminDNI']);
 $query->bindParam(":AdminNombre", $datos['AdminNombre']);
 $query->bindParam(":AdminApellido", $datos['AdminApellido']);
 $query->bindParam(":AdminTelefono", $datos['AdminTelefono']);
 $query->bindParam(":AdminDireccion", $datos['AdminDireccion']);
 $query->bindParam(":CuentaCodigo", $datos['CuentaCodigo']);
 $query->execute();
 return $query;
 }

 protected function eliminarAdministradorModel($CodigoCuentaDelete){
  $query = MainModel::conectar()->prepare("DELETE FROM admin WHERE CuentaCodigo = :CuentaCodigo");
  $query->bindParam(":CuentaCodigo", $CodigoCuentaDelete);
  $query->execute();
  return $query;
 }

}

?>
