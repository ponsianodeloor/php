<?php
if ($peticion_ajax) {
 include_once "../core/MainModel.php";
}else{
 include_once "core/MainModel.php";
}

class Producto extends MainModel{

 function __construct(){

 }

 protected function createProductoModel($datos){
  $query = MainModel::conectar()->prepare("INSERT INTO productos(
                                            nombre,
                                            descripcion,
                                            precio_compra,
                                            precio_venta,
                                            precio_al_por_mayor,
                                            categoria_id,
                                            producto_id_sha1_md5,
                                            producto_user_id_register,
                                            producto_fecha_hora_register
                                           )
                                           VALUES(
                                            :ProductoNombre,
                                            :ProductoDescripcion,
                                            :ProductoPrecioCompra,
                                            :ProductoPrecioVenta,
                                            :ProductoPrecioAlPorMayor,
                                            :ProductoCategoriaId,
                                            :ProductoIdSha1Md5,
                                            :ProductoUserIdRegister,
                                            :ProductoFechaHoraRegister
                                           )
                                          ");
  $query->bindParam(":ProductoNombre",            $datos['ProductoNombre']);
  $query->bindParam(":ProductoDescripcion",       $datos['ProductoDescripcion']);
  $query->bindParam(":ProductoPrecioCompra",      $datos['ProductoPrecioCompra']);
  $query->bindParam(":ProductoPrecioVenta",       $datos['ProductoPrecioVenta']);
  $query->bindParam(":ProductoPrecioAlPorMayor",  $datos['ProductoPrecioAlPorMayor']);
  $query->bindParam(":ProductoCategoriaId",       $datos['ProductoCategoriaId']);
  $query->bindParam(":ProductoIdSha1Md5",         $datos['ProductoIdSha1Md5']);
  $query->bindParam(":ProductoUserIdRegister",    $datos['ProductoUserIdRegister']);
  $query->bindParam(":ProductoFechaHoraRegister", $datos['ProductoFechaHoraRegister']);
  $query->execute();
  return $query;
 }

 protected function readProductoModel($id){
  $query = MainModel::simpleQuery("SELECT * FROM productos WHERE id = :producto_id");
  $query->bindParam(":producto_id", $id);
  $query->execute();
  return $query;
 }

 protected function readProductoAllModel(){
  $query = MainModel::simpleQuery("SELECT * FROM productos ORDER BY nombre");
  $query->execute();
  return $query;
 }

 protected function updateProductoModel($datos){
  $query = MainModel::conectar()->prepare("UPDATE productos SET
                                            nombre = :ProductoNombre,
                                            descripcion = :ProductoDescripcion,
                                            precio_compra = :ProductoPrecioCompra,
                                            precio_venta = :ProductoPrecioVenta,
                                            precio_al_por_mayor = :ProductoPrecioAlPorMayor,
                                            categoria_id = :ProductoCategoriaId
                                            WHERE id = :producto_id
                                          ");
  $query->bindParam(":ProductoNombre", $datos['ProductoNombre']);
  $query->bindParam(":ProductoDescripcion", $datos['ProductoDescripcion']);
  $query->bindParam(":ProductoPrecioCompra", $datos['ProductoPrecioCompra']);
  $query->bindParam(":ProductoPrecioVenta", $datos['ProductoPrecioVenta']);
  $query->bindParam(":ProductoPrecioAlPorMayor", $datos['ProductoPrecioAlPorMayor']);
  $query->bindParam(":ProductoCategoriaId", $datos['ProductoCategoriaId']);
  $query->bindParam(":producto_id", $datos['producto_id']);
  $query->execute();
  return $query;
 }

 protected function deleteProductoModel($data){
  $query = MainModel::conectar()->prepare("DELETE FROM productos WHERE id = :producto_id");
  $query->bindParam(":producto_id", $data['producto_id']);
  $query->execute();
  return $query;
 }

}

?>
