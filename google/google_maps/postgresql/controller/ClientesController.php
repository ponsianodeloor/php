<?php
 if ($peticion_ajax) {
  include_once "../model/Cliente.php";
 }else{
  include_once "model/Cliente.php";
 }

 class ClientesController extends Cliente{

  function __construct(){
   // code...
  }
  //agrega al administrador
  public function agregarClienteController(){

   $txt_cedula = MainModel::limpiarCadena($_POST['txt_cedula']);
   $txt_nombre = MainModel::limpiarCadena($_POST['txt_nombre']);
   $txt_apellido = MainModel::limpiarCadena($_POST['txt_apellido']);
   $txt_telefono = MainModel::limpiarCadena($_POST['txt_telefono']);
   $txt_ocupacion = MainModel::limpiarCadena($_POST['txt_ocupacion']);
   $txt_direccion = MainModel::limpiarCadena($_POST['txt_direccion']);
   $txt_email = MainModel::limpiarCadena($_POST['txt_email']);
   $optGenero = MainModel::limpiarCadena($_POST['optGenero']);

   if ($optGenero == "Masculino") {
    $foto = "Male3Avatar.png";
   }else {
    $foto = "Female3Avatar.png";
   }

   $dataCliente = [
    'ClienteDNI'=>$txt_cedula,
    'ClienteNombre'=> $txt_nombre,
    'ClienteApellido'=> $txt_apellido,
    'ClienteTelefono'=> $txt_telefono,
    'ClienteOcupacion'=> $txt_ocupacion,
    'ClienteDireccion'=> $txt_direccion,
    'ClienteEmail'=>$txt_email,
    'ClienteGenero'=>$optGenero,
    'ClienteFoto'=>$foto
   ];
   $guardarCliente = Cliente::agregarClienteModel($dataCliente);

   if ($guardarCliente->rowCount()>=1) {
    $alerta = [
     "Alerta"=>"limpiar",
     "Titulo"=>"Cliente Registrado",
     "Texto"=>"El cliente se ha registrado correctamente",
     "Tipo"=>"success"
    ];
   }else {
    $alerta = [
     "Alerta"=>"simple",
     "Titulo"=>"Ocurrió un error " ,
     "Texto"=>"El cliente no ha sido registrado",
     "Tipo"=>"error"
    ];
   }
   return MainModel::swetAlert($alerta);
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

  public function obtenerClientes(){
   $sql = "SELECT * FROM cliente ORDER BY ClienteApellido ASC";
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


  public function eliminarAdministradorController(){
   $CuentaCodigo_delete = MainModel::decryption($_POST['CuentaCodigo_delete']);
   $privilegio_admin = MainModel::decryption($_POST['privilegio_admin']);

   $CuentaCodigo_delete = MainModel::limpiarCadena($CuentaCodigo_delete);
   $privilegio_admin = MainModel::limpiarCadena($privilegio_admin);

   if ($privilegio_admin==1) {

    $alerta = [
     "Alerta"=>"simple",
     "Titulo"=>"Admininstrador eliminado",
     "Texto"=>"Se ha eliminado correctamente el administrador",
     "Tipo"=>"success"
    ];


    $sql = MainModel::simpleQuery("SELECT id FROM admin WHERE CuentaCodigo = '$CuentaCodigo_delete'");
    $sql_row_admin = $sql->fetch();
    if ($sql_row_admin['id'] != 1) {
     $administrador_delete = Administrador::eliminarAdministradorModel($CuentaCodigo_delete);
     MainModel::eliminarBitacora($CuentaCodigo_delete);
     if ($administrador_delete->rowCount()>=1) {
      $cuenta_del = MainModel::eliminarCuenta($CuentaCodigo_delete);
      if ($cuenta_del->rowCount()>=1) {
       $alerta = [
        "Alerta"=>"simple",
        "Titulo"=>"Admininstrador eliminado",
        "Texto"=>"Se ha eliminado correctamente el administrador",
        "Tipo"=>"error"
       ];
      }else {
       $alerta = [
        "Alerta"=>"simple",
        "Titulo"=>"Ocurrió un error",
        "Texto"=>"No podemos eliminar esta cuenta en este momento",
        "Tipo"=>"error"
       ];
      }
     }else{
      $alerta = [
       "Alerta"=>"simple",
       "Titulo"=>"Ocurrió un error",
       "Texto"=>"No podemos eliminar al administrador en este momento",
       "Tipo"=>"error"
      ];
     }
    }else{
     $alerta = [
      "Alerta"=>"simple",
      "Titulo"=>"Ocurrió un error",
      "Texto"=>"No puedes eliminar el administrador principal del sistema",
      "Tipo"=>"error"
     ];
    }
   }else{
    $alerta = [
     "Alerta"=>"simple",
     "Titulo"=>"Ocurrió un error",
     "Texto"=>"No tienes permisos necesarios para realizar esta accion",
     "Tipo"=>"error"
    ];
   }
   return MainModel::swetAlert($alerta);
  }//eliminarAdministradorController(){}

  public function consultaAdministradorController($tipo, $CuentaCodigo) {
   $tipo = MainModel::limpiarCadena($tipo);
   $CuentaCodigo = MainModel::decryption($CuentaCodigo);
   return Administrador::consultarAdministradorModel($tipo, $CuentaCodigo);
  }

  public function actualizarAdminController(){
   $txt_cedula = MainModel::limpiarCadena($_POST['txt_cedula']);
   $txt_nombre = MainModel::limpiarCadena($_POST['txt_nombre']);
   $txt_apellido = MainModel::limpiarCadena($_POST['txt_apellido']);
   $txt_telefono = MainModel::limpiarCadena($_POST['txt_telefono']);
   $txt_direccion = MainModel::limpiarCadena($_POST['txt_direccion']);

   $hdd_admin_cuenta_codigo = MainModel::decryption($_POST['hdd_admin_cuenta_codigo']);

   $dataAD = [
    'AdminDNI'=>$txt_cedula,
    'AdminNombre'=> $txt_nombre,
    'AdminApellido'=> $txt_apellido,
    'AdminTelefono'=> $txt_telefono,
    'AdminDireccion'=> $txt_direccion,
    'CuentaCodigo'=>$hdd_admin_cuenta_codigo
   ];
   $guardarAdmin = Administrador::actualizarAdminModel($dataAD);
   if ($guardarAdmin->rowCount()==1) {
    $alerta = [
     "Alerta"=>"limpiar",
     "Titulo"=>"Administrador Actualizado",
     "Texto"=>"El administrador se ha actualizado correctamente",
     "Tipo"=>"success"
    ];
   }else {
    $alerta = [
     "Alerta"=>"simple",
     "Titulo"=>"Ocurrió un error",
     "Texto"=>"No hemos acualizado al administrador",
     "Tipo"=>"error"
    ];
   }
   return MainModel::swetAlert($alerta);
  }//actualizarAdminController()

  public function actualizarCuentaController(){
   $txt_cedula = MainModel::limpiarCadena($_POST['txt_cedula']);
   $txt_nombre = MainModel::limpiarCadena($_POST['txt_nombre']);
   $txt_apellido = MainModel::limpiarCadena($_POST['txt_apellido']);
   $txt_telefono = MainModel::limpiarCadena($_POST['txt_telefono']);
   $txt_direccion = MainModel::limpiarCadena($_POST['txt_direccion']);

   $hdd_admin_cuenta_codigo = MainModel::decryption($_POST['hdd_admin_cuenta_codigo']);

   $dataAD = [
    'AdminDNI'=>$txt_cedula,
    'AdminNombre'=> $txt_nombre,
    'AdminApellido'=> $txt_apellido,
    'AdminTelefono'=> $txt_telefono,
    'AdminDireccion'=> $txt_direccion,
    'CuentaCodigo'=>$hdd_admin_cuenta_codigo
   ];
   $guardarAdmin = Administrador::actualizarAdminModel($dataAD);
   if ($guardarAdmin->rowCount()==1) {
    $alerta = [
     "Alerta"=>"limpiar",
     "Titulo"=>"Administrador Actualizado",
     "Texto"=>"El administrador se ha actualizado correctamente",
     "Tipo"=>"success"
    ];
   }else {
    $alerta = [
     "Alerta"=>"simple",
     "Titulo"=>"Ocurrió un error",
     "Texto"=>"No hemos acualizado al administrador",
     "Tipo"=>"error"
    ];
   }
   return MainModel::swetAlert($alerta);
  }//actualizarAdminController()
 } //class AdministradorController



?>
