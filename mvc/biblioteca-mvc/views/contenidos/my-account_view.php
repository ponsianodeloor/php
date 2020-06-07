<!-- Content page -->
<div class="container-fluid">
 <div class="page-header">
   <h1 class="text-titles"><i class="zmdi zmdi-settings zmdi-hc-fw"></i> MI CUENTA</small></h1>
 </div>
 <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
</div>
<!-- Panel mi cuenta -->
<div class="container-fluid">
 <?php
  $datos = explode("/", $_GET['views']);

 ?>
 <?php if ($datos[1] == "admin"): ?>
  <?php
  if ($_SESSION['usuario_tipo_sbp']!="Administrador") {
   echo $login->forzarCerrarSesion();
  }
  include_once "controller/CuentaController.php";
  $cuentaController = new CuentaController;
  $row_cuentaController = $cuentaController->consultaCuentaController($datos[2]);
  ?>
  <?php if ($row_cuentaController->rowCount() == 1): ?>
   <?php
    $cuenta_data_x_id = $row_cuentaController->fetch();
    if ($cuenta_data_x_id['CuentaCodigo'] != $_SESSION['usuario_cuenta_codigo_sbp']) {
     if ($_SESSION['usuario_privilegio_sbp'] < 1 || $_SESSION['usuario_privilegio_sbp'] > 2) {
      echo $login->forzarCerrarSesion();
     }
    }
   ?>
 <div class="panel panel-success">
  <div class="panel-heading">
   <h3 class="panel-title"><i class="zmdi zmdi-refresh"></i> &nbsp; MI CUENTA</h3>
  </div>
  <div class="panel-body">
   <form action="<?php echo RUTA_URL ?>ajax/cuentaAjax.php" class="FormularioAjax" method="POST" data-form="update" autocomplete="off">
       <fieldset>
        <legend><i class="zmdi zmdi-key"></i> &nbsp; Datos de la cuenta</legend>
        <div class="container-fluid">
         <div class="row">
          <div class="col-xs-12">
           <div class="form-group label-floating">
           <label class="control-label">Nombre de usuario *</label>
           <input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ]{1,15}" class="form-control" type="text" name="txt_usuario" required="" maxlength="15" value="<?php echo $cuenta_data_x_id['CuentaUsuario'] ?>">
        </div>
          </div>
          <div class="col-xs-12 col-sm-6">
        <div class="form-group label-floating">
           <label class="control-label">E-mail</label>
           <input class="form-control" type="email" name="txt_email" maxlength="50" value="<?php echo $cuenta_data_x_id['CuentaEmail'] ?>">
        </div>
          </div>
          <div class="col-xs-12">
        <div class="form-group">
         <label class="control-label">Genero</label>
         <?php
         $cuenta_data_x_id['CuentaGenero']; ?>
         <div class="radio radio-primary">
          <label>
           <input type="radio" name="optGenero" id="optionsRadios1" value="Masculino" <?php if($cuenta_data_x_id['CuentaGenero']=="Masculino"){echo "checked='checked'";} ?>>
           <i class="zmdi zmdi-male-alt"></i> &nbsp; Masculino
          </label>
         </div>
         <div class="radio radio-primary">
          <label>
           <input type="radio" name="optGenero" id="optionsRadios2" value="Femenino" <?php if($cuenta_data_x_id['CuentaGenero']=="Femenino"){echo "checked='checked'";} ?>>
           <i class="zmdi zmdi-female"></i> &nbsp; Femenino
          </label>
         </div>
        </div>
          </div>
         </div>
        </div>
       </fieldset>
       <br>
       <fieldset>
        <legend><i class="zmdi zmdi-lock"></i> &nbsp; Contraseña</legend>
        <p>
         Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo minima cupiditate tempore nobis. Dolor, blanditiis, mollitia. Alias fuga fugiat molestias debitis odit, voluptatibus explicabo quia sequi doloremque numquam dignissimos quis.
        </p>
        <div class="container-fluid">
         <div class="row">
          <div class="col-xs-12">
        <div class="form-group label-floating">
           <label class="control-label">Contraseña actual *</label>
           <input class="form-control" type="password" name="txt_password"  maxlength="70">
        </div>
          </div>
          <div class="col-xs-12 col-sm-6">
        <div class="form-group label-floating">
           <label class="control-label">Nueva contraseña *</label>
           <input class="form-control" type="password" name="txt_password_new"  maxlength="70">
        </div>
          </div>
          <div class="col-xs-12 col-sm-6">
        <div class="form-group label-floating">
           <label class="control-label">Repita la nueva contraseña *</label>
           <input class="form-control" type="password" name="txt_password_new_retype"  maxlength="70">
        </div>
          </div>
         </div>
        </div>
       </fieldset>
       <br>
       <fieldset>
        <legend><i class="zmdi zmdi-star"></i> &nbsp; Nivel de privilegios</legend>
        <div class="container-fluid">
         <div class="row">
          <div class="col-xs-12 col-sm-6">
           <p class="text-left">
                           <div class="label label-success">Nivel 1</div> Control total del sistema
                       </p>
                       <p class="text-left">
                           <div class="label label-primary">Nivel 2</div> Permiso para registro y actualización
                       </p>
                       <p class="text-left">
                           <div class="label label-info">Nivel 3</div> Permiso para registro
                       </p>
          </div>
          <div class="col-xs-12 col-sm-6">
        <div class="radio radio-primary">
         <label>
          <input type="radio" name="optPrivilegio" id="optionsRadios1" value="1" <?php if($cuenta_data_x_id['CuentaPrivilegio']=="1"){echo "checked='checked'";} ?>>
          <i class="zmdi zmdi-star"></i> &nbsp; Nivel 1
         </label>
        </div>
        <div class="radio radio-primary">
         <label>
          <input type="radio" name="optPrivilegio" id="optionsRadios2" value="2" <?php if($cuenta_data_x_id['CuentaPrivilegio']=="2"){echo "checked='checked'";} ?>>
          <i class="zmdi zmdi-star"></i> &nbsp; Nivel 2
         </label>
        </div>
        <div class="radio radio-primary">
         <label>
          <input type="radio" name="optPrivilegio" id="optionsRadios3" value="3" <?php if($cuenta_data_x_id['CuentaPrivilegio']=="3"){echo "checked='checked'";} ?>>
          <i class="zmdi zmdi-star"></i> &nbsp; Nivel 3
         </label>
        </div>
          </div>
         </div>
        </div>
       </fieldset>
       <p class="text-center" style="margin-top: 20px;">
        <button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-refresh"></i> Actualizar</button>
       </p>
       <input type="hidden" name="hdd_cuenta_codigo" value="<?php echo $datos[2]; ?>">
       <div class="RespuestaAjax"></div>
      </form>
  </div>
 </div>
 <?php else: ?>
  <h4>Lo sentimos</h4>
  <p>No podemos mostrar la informacion</p>
 <?php endif; ?>

 <?php elseif($datos[1] == "user"): ?>

 <?php else: ?>
 <h4>Lo sentimos</h4>
 <p>No podemos mostrar la informacion</p>
 <?php endif; ?>
</div>
