<?php
 $peticion_ajax = true;
 require_once "../core/config.php";
 if (isset($_POST['hdd_cuenta_codigo'])) {

  require_once "../controller/CuentaController.php";
  $cuentaController = new CuentaController();

  echo $cuentaController->actualizarCuentaController();

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
