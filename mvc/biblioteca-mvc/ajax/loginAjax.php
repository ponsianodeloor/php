<?php
$peticion_ajax = true;
include_once "../core/config.php";
if (isset($_GET['Token'])) {
 include_once "../controller/LoginController.php";
 $loginController = new LoginController();
 echo $loginController->cerrarSesion();
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
