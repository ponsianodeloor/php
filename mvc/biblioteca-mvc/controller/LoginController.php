<?php
if ($peticion_ajax) {
 include_once "../model/Login.php";
}else{
 include_once "model/Login.php";
}

class LoginController extends Login
{

 function __construct(){

 }

 public function iniciarSesion(){
  $CuentaUsuario = MainModel::limpiarCadena($_POST['txt_user']);

  $CuentaClave = MainModel::limpiarCadena($_POST['txt_pass']);
  $CuentaClave = MainModel::encryption($CuentaClave); //la clave la encriptamos

  $datos = [
   "CuentaUsuario"=>$CuentaUsuario,
   "CuentaClave"=>$CuentaClave
  ];

  $datosLogin = Login::iniciarSesionModel($datos);

  if ($datosLogin->rowCount()==1) {
   $row = $datosLogin->fetch();
   $fechaSystem = date("Y-m-d");
   $yearSystem = date("Y");
   $horaSystem = date("h:i:s");

   $sql = MainModel::simpleQuery("SELECT id FROM bitacora");
   $numero = ($sql->rowCount()) + 1;
   $codigoBitacora = MainModel::generarCodigoAleatorio("CB", 7, $numero);

   $datosBitacora = [
    "BitacoraCodigo"=>$codigoBitacora,
    "BitacoraFecha"=>$fechaSystem,
    "BitacoraHoraInicio"=>$horaSystem,
    "BitacoraHoraFinal"=>'Sin registro',
    "BitacoraTipo"=>$row['CuentaTipo'],
    "BitacoraYear"=>$yearSystem,
    "CuentaCodigo"=>$row['CuentaCodigo']
   ];

   $insertarBitacora = MainModel::guardarBitacora($datosBitacora);

   if ($insertarBitacora->rowCount()>=1) {
    session_start(['name'=>"SistemaBibliotecaPublica"]);

    $_SESSION['usuario_tipo_sbp'] = $row['CuentaTipo'];
    $_SESSION['usuario_sbp'] = $row['CuentaUsuario'];
    $_SESSION['usuario_privilegio_sbp'] = $row['CuentaPrivilegio'];
    $_SESSION['usuario_foto_sbp'] = $row['CuentaFoto'];
    $_SESSION['usuario_token_sbp'] = md5(uniqid(mt_rand(), true));
    $_SESSION['usuario_cuenta_codigo_sbp'] = $row['CuentaCodigo'];
    $_SESSION['usuario_codigo_bitacora_sbp'] = $codigoBitacora;



    switch ($row['CuentaTipo']) {
     case 'Administrador':
      $url = RUTA_URL."home/";
      break;
     case 'Catalog':
      $url = RUTA_URL."catalog/";
      break;
     default:
      // code...
      break;
    }
    return $urlLocation = '<script> window.location = "'.$url.'" </script>';
   }else{
    $alerta = [
     "Alerta"=>"simple",
     "Titulo"=>"Ocurrió un error ",
     "Texto"=>"El no se ha registrado la bitacora",
     "Tipo"=>"error"
    ];
    return MainModel::swetAlert($alerta);
   }
  }else{
   $alerta = [
    "Alerta"=>"simple",
    "Titulo"=>"Ocurrió un error ",
    "Texto"=>"El nombre de usuario y contraseña son incorrectos",
    "Tipo"=>"error"
   ];
   return MainModel::swetAlert($alerta);
  }
 } //iniciarSesion

 public function forzarCerrarSesion(){
  session_destroy();
  return header("Location: ".RUTA_URL."login/" );
 }//forzarCerrarSesion

 public function cerrarSesion(){
  session_start(['name'=>"SistemaBibliotecaPublica"]);
  $token = MainModel::decryption($_GET['Token']);
  $hora = date('h:i:s');
  $datos = [
   "CuentaUsuario"=>$_SESSION['usuario_sbp'],
   "token_usuario"=>$_SESSION['usuario_token_sbp'],
   "token"=>$token,
   "usuario_codigo_bitacora_sbp"=>$_SESSION['usuario_codigo_bitacora_sbp'],
   "hora"=>$hora
  ];
  return Login::cerrarSesionModel($datos);
 }

}

?>
