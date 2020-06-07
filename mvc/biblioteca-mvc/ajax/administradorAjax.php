<?php
 $peticion_ajax = true;
 require_once "../core/config.php";
 if (isset($_POST['txt_cedula']) || isset($_POST['CuentaCodigo_delete']) || isset($_POST['hdd_admin_cuenta_codigo'])) {

  require_once "../controller/AdministradorController.php";
  $administradorController = new AdministradorController();


  if (isset($_POST['txt_cedula']) && isset($_POST['txt_apellido']) && isset($_POST['txt_usuario'])) {
   echo $administradorController->agregarAdministradorController();
  }

  if (isset($_POST['CuentaCodigo_delete']) && isset($_POST['privilegio_admin'])) {
   echo $administradorController->eliminarAdministradorController();
  }

  if (isset($_POST['hdd_admin_cuenta_codigo'])) {
   echo $administradorController->actualizarAdminController();
  }


 }else {
  session_start(['name'=>"SistemaBibliotecaPublica"]);
  session_destroy();

  echo '
   <script>
    window.location.href = "'.RUTA_URL.'login/"
   </script>
  ';

 }
?>
