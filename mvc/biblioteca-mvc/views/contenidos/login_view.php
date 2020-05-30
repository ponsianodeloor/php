<div class="full-box login-container cover">
 <form action="" method="POST" autocomplete="off" class="logInForm">
  <p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
  <p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
  <div class="form-group label-floating">
    <label class="control-label" for="txt_user">Usuario</label>
    <input class="form-control" id="txt_user" type="text" name="txt_user" required = "">
    <p class="help-block">Escribe tú nombre de usuario</p>
  </div>
  <div class="form-group label-floating">
    <label class="control-label" for="txt_pass">Contraseña</label>
    <input class="form-control" id="txt_pass" name="txt_pass" type="password" required = "">
    <p class="help-block">Escribe tú contraseña</p>
  </div>
  <div class="form-group text-center">
   <input type="submit" value="Iniciar sesión" class="btn btn-info" style="color: #FFF;">
  </div>
 </form>
</div>
<?php
 if (isset($_POST['txt_user']) && isset($_POST['txt_pass'])) {
  include_once "controller/LoginController.php";
  $login = new LoginController;
  echo $login->iniciarSesion();
 }
?>
