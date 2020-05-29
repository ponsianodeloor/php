<?php
 $peticion_ajax = true;
 include_once "../core/config.php";
 if (isset($_POST['txt_cedula'])) {
  include_once "../controller/AdministradorController.php";
  $administradorController = new AdministradorController();
  echo $administradorController->agregarAdministradorController();
  if (isset($txt_nombre) && isset($txt_apellido) && isset($txt_usuario)) {

  }
 }else {
  session_start();
  session_destroy();

  echo '
   <script>
    window.location.href = "'.RUTA_URL.'login/"
   </script>
  ';
  
 }
?>
