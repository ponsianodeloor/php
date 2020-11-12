<?php
include_once "../core/MainModel.php";

class User extends MainModel{

 function __construct(){

 }

 protected function agregarUserModel($datos){
  $query = MainModel::conectar()->prepare("INSERT INTO users(
                                            rol_id,
                                            foto_perfil,
                                            username,
                                            pass,
                                            nombres,
                                            apellidos,
                                            sha1_md5_usuario_id,
                                            estado_id
                                           )
                                           VALUES(
                                            :rol_id,
                                            :foto_perfil,
                                            :username,
                                            :pass,
                                            :nombres,
                                            :apellidos,
                                            :sha1_md5_usuario_id,
                                            :estado_id
                                           )
                                          ");
 $query->bindParam(":rol_id", $datos['rol_id']);
 $query->bindParam(":foto_perfil", $datos['foto_perfil']);
 $query->bindParam(":username", $datos['username']);
 $query->bindParam(":pass", $datos['pass']);
 $query->bindParam(":nombres", $datos['nombres']);
 $query->bindParam(":apellidos", $datos['apellidos']);
 $query->bindParam(":sha1_md5_usuario_id", $datos['sha1_md5_usuario_id']);
 $query->bindParam(":estado_id", $datos['estado_id']);
 $query->execute();
 return $query;
 }

 protected function eliminarAdministradorModel($CodigoCuentaDelete){
  $query = MainModel::conectar()->prepare("DELETE FROM admin WHERE CuentaCodigo = :CuentaCodigo");
  $query->bindParam(":CuentaCodigo", $CodigoCuentaDelete);
  $query->execute();
  return $query;
 }

 protected function consultarAdministradorModel($tipo, $CuentaCodigo){
  if ($tipo == "Unico") {
   $query = MainModel::simpleQuery("SELECT * FROM admin WHERE CuentaCodigo = :CuentaCodigo");
   $query->bindParam(":CuentaCodigo", $CuentaCodigo);
  }elseif($tipo == "Conteo") {
   $query = MainModel::simpleQuery("SELECT id FROM admin WHERE id != '1'");
  }
  $query->execute();
   return $query;
 }

 protected function actualizarAdminModel($datos){
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
