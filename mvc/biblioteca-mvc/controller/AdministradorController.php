<?php
 if ($peticion_ajax) {
  include_once "../model/Administrador.php";
 }else{
  include_once "model/Administrador.php";
 }

 class AdministradorController extends Administrador{

  function __construct(){
   // code...
  }

  public function agregarAdministradorController(){

   $txt_cedula = $_POST['txt_cedula'];
   $txt_nombre = $_POST['txt_nombre'];
   $txt_apellido = $_POST['txt_apellido'];
   $txt_telefono = $_POST['txt_telefono'];
   $txt_direccion = $_POST['txt_direccion'];


   $txt_usuario = $_POST['txt_usuario'];
   $txt_password = $_POST['txt_password'];
   $txt_password_retype = $_POST['txt_password_retype'];
   $txt_email = $_POST['txt_email'];
   $optGenero = $_POST['optGenero'];
   $optPrivilegio = $_POST['optPrivilegio'];

   if ($optGenero == "Masculino") {
    $foto = "Male3Avatar.png";
   }else {
    $foto = "Female3Avatar.png";
   }


   if ($txt_password != $txt_password_retype) {
    $alerta = [
     "Alerta"=>"simple",
     "Titulo"=>"Ocurrió un error ",
     "Texto"=>"Las constraseñas no coinciden",
     "Tipo"=>"error"
    ];
   }else {

     $sql = MainModel::simpleQuery("SELECT AdminDNI FROM admin WHERE AdminDNI = '$txt_cedula'");
     if ($sql->rowCount()>=1) {
      $alerta = [
       "Alerta"=>"simple",
       "Titulo"=>"Ocurrió un error",
       "Texto"=>"La cédula ingresada ya está registrada en el sistema",
       "Tipo"=>"error"
      ];
     }else {
      if ($txt_email != "") {
       $sql = MainModel::simpleQuery("SELECT CuentaEmail FROM cuenta WHERE CuentaEmail = '$txt_email'");
       $comprobar_txt_email = $sql->rowCount();
      }else {
       $comprobar_txt_email = 0;
      }
      if ($comprobar_txt_email >= 1) {
       $alerta = [
        "Alerta"=>"simple",
        "Titulo"=>"Ocurrió un error",
        "Texto"=>"El email ya está registrada en el sistema",
        "Tipo"=>"error"
       ];
      }else {
       $sql = MainModel::simpleQuery("SELECT CuentaUsuario FROM cuenta WHERE CuentaUsuario = '$txt_usuario'");
       if ($sql->rowCount()>=1) {
        $alerta = [
         "Alerta"=>"simple",
         "Titulo"=>"Ocurrió un error",
         "Texto"=>"El usuario ya está registrada en el sistema",
         "Tipo"=>"error"
        ];
       }else{
         $sql = MainModel::simpleQuery("SELECT id FROM cuenta");
         $numero = ($sql->rowCount())+1;
         $codigo = MainModel::generarCodigoAleatorio("AC", 7, $numero);
         $clave = MainModel::encryption($txt_password);

         $dataAC = [
          'CuentaCodigo'=>$codigo,
          'CuentaPrivilegio'=> $optPrivilegio,
          'CuentaUsuario'=> $txt_usuario,
          'CuentaClave'=> $clave,
          'CuentaEmail'=> $txt_email,
          'CuentaEstado'=>'Activo',
          'CuentaTipo'=>'Administrador',
          'CuentaGenero'=>$optGenero,
          'CuentaFoto'=>$foto
         ];
         $guardarCuenta = MainModel::agregarCuenta($dataAC);

        if ($guardarCuenta->rowCount()>=1) {

         $dataAD = [
          'AdminDNI'=>$txt_cedula,
          'AdminNombre'=> $txt_nombre,
          'AdminApellido'=> $txt_apellido,
          'AdminTelefono'=> $txt_telefono,
          'AdminDireccion'=> $txt_direccion,
          'CuentaCodigo'=>$codigo
         ];
        $guardarAdmin = Administrador::agregarAdministradorModel($dataAD);

        if ($guardarAdmin->rowCount()>=1) {
         $alerta = [
          "Alerta"=>"limpiar",
          "Titulo"=>"Administrador Registrado",
          "Texto"=>"El administrador se ha registrado correctamente",
          "Tipo"=>"success"
         ];
        }else {
         MainModel::eliminarCuenta($codigo);
         $alerta = [
          "Alerta"=>"simple",
          "Titulo"=>"Ocurrió un error",
          "Texto"=>"No hemos agregado al administrador",
          "Tipo"=>"error"
         ];
        }

        }else {
         $alerta = [
          "Alerta"=>"simple",
          "Titulo"=>"Ocurrió un error",
          "Texto"=>"No hemos agregado la cuenta",
          "Tipo"=>"error"
         ];
        }

       }
      }
     }
   }
   return MainModel::swetAlert($alerta);
  }

 }



?>
