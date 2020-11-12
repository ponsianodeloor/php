<?php
if ($peticion_ajax) {
 include_once "../core/MainModel.php";
}else{
 include_once "core/MainModel.php";
}

class Cuota extends MainModel{

 function __construct(){

 }

 protected function actualizarCuotaModel($datos){

  //actualizar las tablas que se relacionan con el cobro
  $prestamo_id = $datos['hdd_prestamo_id'];
  $RsPrestamo_x_id = MainModel::getRows("SELECT * FROM prestamos WHERE id = $prestamo_id");
  foreach ($RsPrestamo_x_id as $row_RsPrestamo_x_id) {
   $cant_cuotas = $row_RsPrestamo_x_id['cant_cuotas'];
   $cant_cuotas = $row_RsPrestamo_x_id['cant_cuotas'] - 1;
   $saldo = intval($row_RsPrestamo_x_id['saldo']) - intval($row_RsPrestamo_x_id['cuota']);
  }
  //restamos el saldo y la cant de cuotas
  $tabla = "prestamos";
  $campos = array(
   "cant_cuotas",
   "saldo"
  );
  $valores = array(
   $cant_cuotas,
   $saldo
  );
  $condicion = "WHERE id = $prestamo_id";
  MainModel::actualizarRegistro($tabla, $campos, $valores, $condicion);

  //actualizamos las cuotas
  $query = MainModel::conectar()->prepare("UPDATE cuotas SET
                                            fecha_cobrado = :fecha_cobrado,
                                            dias_atraso = :dias_atraso,
                                            estado_id = :estado_id,
                                            fecha_hora_register = :fecha_hora_register
                                           WHERE id = :hdd_cuota_id
                                          ");
  $query->bindParam(":fecha_cobrado", $datos['fecha_cobrado']);
  $query->bindParam(":dias_atraso", $datos['dias_atraso']);
  $query->bindParam(":estado_id", $datos['estado_id']);
  $query->bindParam(":fecha_hora_register", $datos['fecha_hora_register']);
  $query->bindParam(":hdd_cuota_id", $datos['hdd_cuota_id']);

  //guardar los cobros a efectuarse
  $query->execute();



  return $query;
 }

}

?>
