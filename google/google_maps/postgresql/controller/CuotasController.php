<?php
 if ($peticion_ajax) {
  include_once "../model/Cuota.php";
 }else{
  include_once "model/Cuota.php";
 }

 class CuotasController extends Cuota{

  function __construct(){
   // code...
  }
  //agrega al administrador
  public function actualizarCuotaController(){

   //datos del formulario
   $hdd_cuota_id = MainModel::decryption($_POST['hdd_cuota_id']);
   $hdd_prestamo_id = MainModel::decryption($_POST['hdd_prestamo_id']);

   $RsCuota_id = MainModel::getRows("SELECT * FROM cuotas WHERE id = $hdd_cuota_id");
   //obtenemos la fecha para calcular los dias de diferencias
   foreach ($RsCuota_id as $row_RsCuota_id) {
    $fecha_cobro = $row_RsCuota_id['fecha_cobro'];
   }
   if (date('Y-m-d') > $fecha_cobro) {
    $diferencias_fechas = MainModel::diferencias_fechas($fecha_cobro, date('Y-m-d'));
   }else {
    $diferencias_fechas = 0;
   }

   ///obtenemos la fecha para calcular los dias de diferencias

   $dataCuota = [
    'fecha_cobrado' => date('Y-m-d'),
    'dias_atraso' => $diferencias_fechas,
    'estado_id' => 2,
    'fecha_hora_register', date('Y-m-d H:i:s'),
    'hdd_prestamo_id' => $hdd_prestamo_id,
    'hdd_cuota_id' => $hdd_cuota_id
   ];

   //comprobar si la cuota anterior esta pagada
   ///obtenemos el prestamo_id de la cuota para guardar las cuotas en un array
   $i = 0;
   $cuota_estado = array();
   $RsCuotas_x_prestamo_id = MainModel::getRows("SELECT * FROM cuotas WHERE prestamo_id = $hdd_prestamo_id AND id <= $hdd_cuota_id AND estado_id = 1");
   foreach ($RsCuotas_x_prestamo_id as $row_RsCuotas_x_prestamo_id) {
    $prestamo_id = $row_RsCuota_id['prestamo_id'];
    $cuota_estado[$i] = $row_RsCuota_id['estado_id'];
    $i++;
   }

   for ($i=0; $i < count($cuota_estado); $i++) {
    $cuota_estado[$i];
   }
   if (count($cuota_estado) == 1) {
    $actualizarCuota = Cuota::actualizarCuotaModel($dataCuota);
    if ($actualizarCuota->rowCount()==1) {
     $alerta = [
      "Alerta"=>"simple",
      "Titulo"=>"Cuota Registrada",
      "Texto"=>"La cuota se ha registrado correctamente",
      "Tipo"=>"success"
     ];
    }else {
     $alerta = [
      "Alerta"=>"simple",
      "Titulo"=>"Ocurrió un error " ,
      "Texto"=>"La cuota no ha sido registrada",
      "Tipo"=>"error"
     ];
    }
   }elseif($cuota_estado[$i - 1] == 2){
    $actualizarCuota = Cuota::actualizarCuotaModel($dataCuota);
    if ($actualizarCuota->rowCount()==1) {
     $alerta = [
      "Alerta"=>"simple",
      "Titulo"=>"Cuota Registrada",
      "Texto"=>"La cuota se ha registrado correctamente",
      "Tipo"=>"success"
     ];
    }else {
     $alerta = [
      "Alerta"=>"simple",
      "Titulo"=>"Ocurrió un error " ,
      "Texto"=>"La cuota no ha sido registrada",
      "Tipo"=>"error"
     ];
    }
   }else {
    $alerta = [
     "Alerta"=>"simple",
     "Titulo"=>"Atencion",
     "Texto"=>"No se pueden cobrar cuotas adelantadas",
     "Tipo"=>"warning"
    ];
   }

   //comprobar si la cuota anterior esta pagada


   //actualizar el estado de la cuota por el id




   return MainModel::swetAlert($alerta);
   ///actualizar el estado de la cuota por el id
  }
 } //class CuotaController



?>
