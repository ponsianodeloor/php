<?php
if ($peticion_ajax) {
 include_once "../model/Cuenta.php";
}else{
 include_once "model/Cuenta.php";
}

class CuentaController extends Cuenta{

 function __construct(){

 }

 public function consultaCuentaController($CuentaCodigo) {
  $CuentaCodigo = MainModel::decryption($CuentaCodigo);
  return Cuenta::consultarCuentaModel($CuentaCodigo);
 }

 public function actualizarCuentaController(){
  $txt_usuario = MainModel::limpiarCadena($_POST['txt_usuario']);
  $txt_email = MainModel::limpiarCadena($_POST['txt_email']);
  $optGenero = MainModel::limpiarCadena($_POST['optGenero']);
  $optPrivilegio = MainModel::limpiarCadena($_POST['optPrivilegio']);

  $hdd_cuenta_codigo = MainModel::limpiarCadena($_POST['hdd_cuenta_codigo']);
  $hdd_cuenta_codigo = MainModel::decryption($_POST['hdd_cuenta_codigo']);

  if ($optGenero == "Masculino") {
   $foto = "Male3Avatar.png";
  }else {
   $foto = "Female3Avatar.png";
  }

  $dataCuentaActualizar = [
   'CuentaUsuario'=>$txt_usuario,
   'CuentaEmail'=>$txt_email,
   'CuentaGenero'=>$optGenero,
   'CuentaPrivilegio'=>$optPrivilegio,
   'CuentaFoto'=>$foto,
   'CuentaCodigo'=>$hdd_cuenta_codigo
  ];
  $actualizarCuenta = Cuenta::actualizarCuentaModel($dataCuentaActualizar);
  if ($actualizarCuenta->rowCount()==1) {
   $alerta = [
    "Alerta"=>"limpiar",
    "Titulo"=>"Cuenta Actualizada",
    "Texto"=>"La cuenta se ha actualizado correctamente",
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
 }
}

?>
