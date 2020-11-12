<?php
 if ($peticion_ajax) {
  include_once "../model/Prestamo.php";
 }else{
  include_once "model/Prestamo.php";
 }

 class PrestamosController extends Prestamo{

  function __construct(){
   // code...
  }
  //agrega al administrador
  public function agregarPrestamoController(){

   $txt_fecha_inicio = MainModel::limpiarCadena($_POST['txt_fecha_inicio']);
   $lstValorPrestamo = MainModel::limpiarCadena($_POST['lstValorPrestamo']);
   $hdd_cliente_id = MainModel::limpiarCadena($_POST['hdd_cliente_id']);
   $hdd_user_register_id = MainModel::limpiarCadena($_POST['hdd_user_register_id']);

   //obtener datos de la tabla prestamos por el id
   $RsPrestamos_valor_x_id = MainModel::getRows("SELECT * FROM prestamos_valor WHERE id = $lstValorPrestamo");
   foreach ($RsPrestamos_valor_x_id as $row_RsPrestamos_valor_x_id) {
    $prestamo_valor = $row_RsPrestamos_valor_x_id['valor'];
   }
   ///obtener datos de la tabla prestamos por el id

   //obtener datos de la tabla system_config para obtener el interes
   $RsSystemConfig = MainModel::getRows("SELECT * FROM system_config");
   foreach ($RsSystemConfig as $row_RsSystemConfig) {
    $porcentaje_interes = $row_RsSystemConfig['porcentaje_interes'];
    $cant_dias_prestamo = $row_RsSystemConfig['cant_dias_prestamo'];
   }
   ///obtener datos de la tabla system_config para obtener el interes

   //calcular el valor total del prestamo
   $interes = $prestamo_valor * ($porcentaje_interes * 0.01);
   $valor_total_prestamo = $prestamo_valor + ($prestamo_valor * ($porcentaje_interes * 0.01));
   $cuota = $valor_total_prestamo / $cant_dias_prestamo;
   $cant_cuotas = $cant_dias_prestamo;

   if ($lstValorPrestamo != '-1') {
    $dataPrestamo = [
     'fecha_inicio'=>$txt_fecha_inicio,
     'cliente_id'=> $hdd_cliente_id,
     'prestamo_valor_id'=> $lstValorPrestamo,
     'saldo'=> $valor_total_prestamo,
     'valor'=>$prestamo_valor,
     'interes_porcentaje' => $porcentaje_interes,
     'interes_valor'=> $interes,
     'cuota'=>$cuota,
     'cant_cuotas'=>$cant_dias_prestamo,
     'valor_total' =>$valor_total_prestamo,
     'fecha_hora_register'=> date('Y-m-d H:i:s'),
     'hdd_user_register_id' => $hdd_user_register_id
    ];
    $guardarPrestamo = Prestamo::agregarPrestamoModel($dataPrestamo);

    if ($guardarPrestamo->rowCount()>=1) {
     $alerta = [
      "Alerta"=>"limpiar",
      "Titulo"=>"Prestamo Registrado",
      "Texto"=>"El prestamo se ha registrado correctamente",
      "Tipo"=>"success"
     ];

     //guardar los cobros
     $last_prestamo_id = MainModel::get_id("id", "prestamos");
     for ($i=0; $i < $cant_dias_prestamo ; $i++) {
      //sumar las fechas
      $fecha_cobro = MainModel::sumar_restar_dias_fecha($txt_fecha_inicio, $i);
      $tabla = "cuotas";
      $campos = array(
       "prestamo_id",
       "cuota_num",
       "fecha_cobro",
       "valor_cobro",
       "user_register_id",
       "fecha_hora_register"
      );
      $valores = array(
       $last_prestamo_id,
       $i+1,
       $fecha_cobro,
       $cuota,
       $hdd_user_register_id,
       MainModel::fechaHoraSystem()
      );
      MainModel::insertarRegistro($tabla, $campos, $valores);
     }

    }else {
     $alerta = [
      "Alerta"=>"simple",
      "Titulo"=>"Ocurrió un error " ,
      "Texto"=>"El prestamo no ha sido registrado",
      "Tipo"=>"error"
     ];
    }
    return MainModel::swetAlert($alerta);
   }else { //if ($lstValorPrestamo != '-1') {
    $alerta = [
     "Alerta"=>"simple",
     "Titulo"=>"Valor del prestamo" ,
     "Texto"=>"Debe selecionar el valor del prestamo",
     "Tipo"=>"warning"
    ];
    return MainModel::swetAlert($alerta);
   }

  }

  public function obtenerCliente($ClienteSha1Md5Id){
   $sql = "SELECT * FROM cliente WHERE ClienteSha1Md5Id = '$ClienteSha1Md5Id'";
   $datos = MainModel::simpleQuery($sql);
   $datos = $datos->fetchAll();
   return $datos;

   /*
    uso en vistas
    $datos = explode("/", $_GET['views']);
    $ClienteSha1Md5Id = $datos[1];
    $ClienteSha1Md5Id;
    include_once "controller/ClientesController.php";
    $clientesController = new ClientesController;
    $datosCliente = $clientesController->obtenerCliente($ClienteSha1Md5Id);
    foreach ($datosCliente as $row_datosCliente) {
     $ClienteNombre = $row_datosCliente['ClienteNombre'];
     $ClienteApellido = $row_datosCliente['ClienteApellido'];
    }
   */
  }

  public function obtenerPrestamosController(){
   $sql = "SELECT * FROM prestamos ORDER BY cliente_id ASC";
   $datos = MainModel::simpleQuery($sql);
   $datos = $datos->fetchAll();


   $tabla = "";
   $tabla.='<div class="table-responsive">
             <table class="table table-hover text-center">
              <thead>
               <tr>
                <th class="text-center">Prestamos</th>
                <th class="text-center">NOMBRES</th>
                <th class="text-center">APELLIDOS</th>
                <th class="text-center">TELÉFONO</th>';

   $tabla.='   </tr>
              </thead>
              <tbody>';

   foreach ($datos as $row_datos) {
    $tabla .= '
            <tr>
             <td>
              <a href="'.RUTA_URL.'client-loans/'.$row_datos['ClienteSha1Md5Id'].'/" class="btn btn-success btn-raised btn-xs">
               <i class="zmdi zmdi-refresh"></i>
              </a>
             </td>
             <td>'.$row_datos['ClienteNombre'].'</td>
             <td>'.$row_datos['ClienteApellido'].'</td>
             <td>'.$row_datos['ClienteTelefono'].'</td>';
            }

   $tabla.='  </tbody>
             </table>
             </div>';

   return $tabla;
  }



 } //class AdministradorController



?>
