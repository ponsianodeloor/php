<?php
 include_once "../model/User.php";

 class UsersController extends User{

  function __construct(){
   // code...
  }
  //agrega al administrador
  public function agregarUserController(){

   $rol_id = 1;
   $foto_perfil = "Male3Avatar";
   $username = "ponsianodeloor";
   $pass = MainModel::encryption("ponsiano");
   $nombres = "Ponsiano";
   $apellidos = "De Loor";
   $sha1_md5_usuario_id = sha1(md5(date('Y-m-d H:i:s').$username));
   $estado_id = 1;


   $data = [
    'rol_id'=>$rol_id,
    'foto_perfil'=>$foto_perfil,
    'username'=>$username,
    'pass'=> $pass,
    'nombres'=> $nombres,
    'apellidos'=> $apellidos,
    'sha1_md5_usuario_id'=> $sha1_md5_usuario_id,
    'estado_id'=> $estado_id
   ];
   $guardarData = User::agregarUserModel($data);
   if ($guardarData->rowCount() == 1) {
    return "dato_guardado";
   }else{

    return "no se ha guardado";
   }

   // $txt_usuario = MainModel::limpiarCadena($_POST['txt_usuario']);
   // $txt_password = MainModel::limpiarCadena($_POST['txt_password']);
   // $txt_password_retype = MainModel::limpiarCadena($_POST['txt_password_retype']);
   // $txt_email = MainModel::limpiarCadena($_POST['txt_email']);
   // $optGenero = MainModel::limpiarCadena($_POST['optGenero']);
   // $optPrivilegio = MainModel::decryption($_POST['optPrivilegio']);







  }

  //paginador de administradores
  public function paginadorAdministradorController($pagina, $registros, $privilegio, $codigo_session, $busqueda){
   $pagina = MainModel::limpiarCadena($pagina);
   $registros = MainModel::limpiarCadena($registros); //cuantos registros por pagina
   $privilegio = MainModel::limpiarCadena($privilegio);
   $codigo_session = MainModel::limpiarCadena($codigo_session);
   $busqueda = MainModel::limpiarCadena($busqueda);
   $tabla = "";

   $pagina = (isset($pagina) && $pagina >0) ? (int) $pagina :1;
   $inicio = ($pagina > 0) ? (($pagina * $registros)-$registros) : 0;

   if (isset($busqueda) && $busqueda!= "") {
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM admin WHERE (CuentaCodigo !='$codigo_session' AND id!='1') AND (AdminNombre LIKE '%$busqueda%' OR AdminApellido LIKE '%$busqueda%') ORDER BY AdminApellido ASC LIMIT $inicio, $registros";
    $pagina_url = "admin-search";
   }else {
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM admin WHERE CuentaCodigo !='$codigo_session' AND id!='1' ORDER BY AdminApellido ASC LIMIT $inicio, $registros";
    $pagina_url = "admin_list";
   }

   $datos = MainModel::simpleQuery($sql);
   $datos = $datos->fetchAll();
   $total = MainModel::simpleQuery("SELECT FOUND_ROWS()");
   $total = (int) $total->fetchColumn();

   $numeroPaginas = ceil($total/$registros);
   echo $privilegio;
   $tabla.='<div class="table-responsive">
             <table class="table table-hover text-center">
              <thead>
               <tr>
                <th class="text-center">#</th>
                <th class="text-center">DNI</th>
                <th class="text-center">NOMBRES</th>
                <th class="text-center">APELLIDOS</th>
                <th class="text-center">TELÉFONO</th>';
    if ($privilegio <=2) {
     $tabla.='
                <th class="text-center">A. CUENTA</th>
                <th class="text-center">A. DATOS</th>
      ';
    }
    if ($privilegio ==1) {
     $tabla.='
                <th class="text-center">ELIMINAR</th>
      ';
    }
   $tabla.='   </tr>
              </thead>
              <tbody>';
   if ($total > 0 && $pagina <= $numeroPaginas) {
    $contador = $inicio++;
    foreach ($datos as $row_datos) {
     $tabla .= '
             <tr>
              <td>'.$contador.'</td>
              <td>'.$row_datos['AdminDNI'].'</td>
              <td>'.$row_datos['AdminNombre'].'</td>
              <td>'.$row_datos['AdminApellido'].'</td>
              <td>'.$row_datos['AdminTelefono'].'</td>';

     if ($privilegio <=2) {
      $tabla.='
              <td>
               <a href="'.RUTA_URL.'my-account/admin/'.MainModel::encryption($row_datos['CuentaCodigo']).'/" class="btn btn-success btn-raised btn-xs">
                <i class="zmdi zmdi-refresh"></i>
               </a>
              </td>
              <td>
               <a href="'.RUTA_URL.'my-data/admin/'.MainModel::encryption($row_datos['CuentaCodigo']).'/" class="btn btn-success btn-raised btn-xs">
                <i class="zmdi zmdi-refresh"></i>
               </a>
              </td>
       ';
     }
     if ($privilegio ==1) {
      $tabla.='
              <td>
              <form action="'.RUTA_URL.'ajax/administradorAjax.php" method="POST" class="FormularioAjax" data-form="delete" entype="multipart/form-data" autocomplete="off">
               <input type="hidden" name="CuentaCodigo_delete" value="'.MainModel::encryption($row_datos['CuentaCodigo']).'">
               <input type="hidden" name="privilegio_admin" value="'.MainModel::encryption($privilegio).'">
               <button type="submit" class="btn btn-danger btn-raised btn-xs">
                <i class="zmdi zmdi-delete"></i>
               </button>
               <div class="RespuestaAjax"></div>
              </form>
             </td>
       ';
     }
     $tabla.=' </tr>';
     $contador++;
    }
   }else {
    if ($total>=1) {
     $tabla.='
     <tr>
      <td colspan="8">
       <a href="'.RUTA_URL.$pagina_url.'/" class="btn btn-sm btn-info btn-raised">Haga clic para recargar </a>
      <td>
     </tr>
     ';
    }else {
     $tabla.='
     <tr>
      <td colspan="8">
      No hay registros en el sistema
      <td>
     </tr>
     ';
    }
   }

   $tabla.='  </tbody>
             </table>
             </div>';

   //Paginador
   if ($total > 0 && $pagina <= $numeroPaginas) {
    $tabla.='
             <nav class="text-center">
              <ul class="pagination pagination-sm">
    ';
    //boton ir anterior
    if ($pagina == 1) {
     $tabla.='
               <li class="disabled"><a><i class="zmdi zmdi-arrow-left"></i></a></li>
     ';
    }else{
     $tabla.='
               <li><a href="'.RUTA_URL.$pagina_url.'/'.($pagina-1).'/"><i class="zmdi zmdi-arrow-left"></i></a></li>
     ';
    }

    //numeracion de paginas con for
    for ($i=1; $i <=$numeroPaginas ; $i++) {
     if ($pagina == $i) {
      $tabla.='
                <li class="active"><a href="'.RUTA_URL.$pagina_url.'/'.$i.'/">'.$i.'</a></li>
      ';
     }else {
      $tabla.='
                <li><a href="'.RUTA_URL.$pagina_url.'/'.$i.'/">'.$i.'</a></li>
      ';
     }
    }

    //boton ir siguiente
    if ($pagina == $numeroPaginas) {
     $tabla.='
               <li class="disabled"><a><i class="zmdi zmdi-arrow-right"></i></a></li>
     ';
    }else{
     $tabla.='
               <li><a href="'.RUTA_URL.$pagina_url.'/'.($pagina+1).'/"><i class="zmdi zmdi-arrow-right"></i></a></li>
     ';
    }

    $tabla.='
              </ul>
             </nav>
    ';
   }

   return $tabla;
  }

  public function obtenerAdministradores(){
   $sql = "SELECT * FROM admin WHERE id!='1' ORDER BY AdminApellido ASC";
   $datos = MainModel::simpleQuery($sql);
   $datos = $datos->fetchAll();


   $tabla = "";
   $tabla.='<div class="table-responsive">
             <table class="table table-hover text-center">
              <thead>
               <tr>
                <th class="text-center">DNI</th>
                <th class="text-center">NOMBRES</th>
                <th class="text-center">APELLIDOS</th>
                <th class="text-center">TELÉFONO</th>';

   $tabla.='   </tr>
              </thead>
              <tbody>';

   foreach ($datos as $row_datos) {
    $tabla .= '
            <tr>
             <td>'.$row_datos['AdminDNI'].'</td>
             <td>'.$row_datos['AdminNombre'].'</td>
             <td>'.$row_datos['AdminApellido'].'</td>
             <td>'.$row_datos['AdminTelefono'].'</td>';
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
