<?php
if ($peticion_ajax) {
 include_once "../core/MainModel.php";
}else{
 include_once "core/MainModel.php";
}

class Categoria extends MainModel{

 function __construct(){

 }

 protected function agregarClienteModel($datos){
  $query = MainModel::conectar()->prepare("INSERT INTO cliente(
                                            ClienteSha1Md5Id,
                                            ClienteDNI,
                                            ClienteNombre,
                                            ClienteApellido,
                                            ClienteTelefono,
                                            ClienteOcupacion,
                                            ClienteDireccion,
                                            ClienteEmail,
                                            ClienteGenero,
                                            ClienteFoto,
                                            ClienteFechaRegistro
                                           )
                                           VALUES(
                                            :ClienteSha1Md5Id,
                                            :ClienteDNI,
                                            :ClienteNombre,
                                            :ClienteApellido,
                                            :ClienteTelefono,
                                            :ClienteOcupacion,
                                            :ClienteDireccion,
                                            :ClienteEmail,
                                            :ClienteGenero,
                                            :ClienteFoto,
                                            :ClienteFechaRegistro
                                           )
                                          ");
 $query->bindParam(":ClienteSha1Md5Id", sha1(md5(date('Y_m_d_His'))));
 $query->bindParam(":ClienteDNI", $datos['ClienteDNI']);
 $query->bindParam(":ClienteNombre", $datos['ClienteNombre']);
 $query->bindParam(":ClienteApellido", $datos['ClienteApellido']);
 $query->bindParam(":ClienteTelefono", $datos['ClienteTelefono']);
 $query->bindParam(":ClienteOcupacion", $datos['ClienteOcupacion']);
 $query->bindParam(":ClienteDireccion", $datos['ClienteDireccion']);
 $query->bindParam(":ClienteEmail", $datos['ClienteEmail']);
 $query->bindParam(":ClienteGenero", $datos['ClienteGenero']);
 $query->bindParam(":ClienteFoto", $datos['ClienteFoto']);
 $query->bindParam(":ClienteFechaRegistro", date('Y-m-d H:i:s'));
 $query->execute();
 return $query;
 }

 protected function eliminarClienteModel($CodigoCuentaDelete){
  $query = MainModel::conectar()->prepare("DELETE FROM admin WHERE CuentaCodigo = :CuentaCodigo");
  $query->bindParam(":CuentaCodigo", $CodigoCuentaDelete);
  $query->execute();
  return $query;
 }

 protected function consultarClienteModel($tipo, $CuentaCodigo){
  if ($tipo == "Unico") {
   $query = MainModel::simpleQuery("SELECT * FROM admin WHERE CuentaCodigo = :CuentaCodigo");
   $query->bindParam(":CuentaCodigo", $CuentaCodigo);
  }elseif($tipo == "Conteo") {
   $query = MainModel::simpleQuery("SELECT id FROM admin WHERE id != '1'");
  }
  $query->execute();
   return $query;
 }

 protected function actualizarClienteModel($datos){
  $query = MainModel::conectar()->prepare("UPDATE admin SET
                                            AdminDNI = :AdminDNI,
                                            AdminNombre = :AdminNombre,
                                            AdminApellido = :AdminApellido,
                                            AdminTelefono = :AdminTelefono,
                                            AdminDireccion = :AdminDireccion
                                            WHERE CuentaCodigo = :CuentaCodigo
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

}

?>
