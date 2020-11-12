<?php
if ($peticion_ajax) {
 include_once "../core/MainModel.php";
}else{
 include_once "core/MainModel.php";
}

class Prestamo extends MainModel{

 function __construct(){

 }

 protected function agregarPrestamoModel($datos){
  $query = MainModel::conectar()->prepare("INSERT INTO prestamos(
                                            fecha_inicio,
                                            cliente_id,
                                            prestamo_valor_id,
                                            saldo,
                                            valor,
                                            interes_porcentaje,
                                            interes_valor,
                                            cuota,
                                            cant_cuotas,
                                            valor_total,
                                            fecha_hora_register,
                                            user_register_id
                                           )
                                           VALUES(
                                            :fecha_inicio,
                                            :cliente_id,
                                            :prestamo_valor_id,
                                            :saldo,
                                            :valor,
                                            :interes_porcentaje,
                                            :interes_valor,
                                            :cuota,
                                            :cant_cuotas,
                                            :valor_total,
                                            :fecha_hora_register,
                                            :user_register_id
                                           )
                                          ");
 $query->bindParam(":fecha_inicio", $datos['fecha_inicio']);
 $query->bindParam(":cliente_id", $datos['cliente_id']);
 $query->bindParam(":prestamo_valor_id", $datos['prestamo_valor_id']);
 $query->bindParam(":saldo", $datos['saldo']);
 $query->bindParam(":valor", $datos['valor']);
 $query->bindParam(":interes_porcentaje", $datos['interes_porcentaje']);
 $query->bindParam(":interes_valor", $datos['interes_valor']);
 $query->bindParam(":cuota", $datos['cuota']);
 $query->bindParam(":cant_cuotas", $datos['cant_cuotas']);
 $query->bindParam(":valor_total", $datos['valor_total']);
 $query->bindParam(":fecha_hora_register", $datos['fecha_hora_register']);
 $query->bindParam(":user_register_id", $datos['hdd_user_register_id']);

 //guardar los cobros a efectuarse
 $query->execute();
 return $query;
 }

}

?>
