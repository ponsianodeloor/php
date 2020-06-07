<!-- Content page -->
<div class="container-fluid">
 <div class="page-header">
   <h1 class="text-titles"><i class="zmdi zmdi-account-circle zmdi-hc-fw"></i> MIS DATOS</small></h1>
 </div>
 <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
</div>

<!-- Panel mis datos -->
<div class="container-fluid">
  <?php
   $datos = explode("/", $_GET['views']);
  ?>
  <?php if ($datos[1] == "admin"): ?>
   <?php
   if ($_SESSION['usuario_tipo_sbp']!="Administrador") {
    echo $login->forzarCerrarSesion();
   }
   include_once "controller/AdministradorController.php";
   $administradorController = new AdministradorController;
   $row_administradorController = $administradorController->consultaAdministradorController("Unico", $datos[2]);
   ?>
   <?php if ($row_administradorController->rowCount() == 1): ?>
    <?php
     $admin_data_x_id = $row_administradorController->fetch();
     if ($admin_data_x_id['CuentaCodigo'] != $_SESSION['usuario_cuenta_codigo_sbp']) {
      if ($_SESSION['usuario_privilegio_sbp'] < 1 || $_SESSION['usuario_privilegio_sbp'] > 2) {
       echo $login->forzarCerrarSesion();
      }
     }
    ?>
    <div class="panel panel-success">
     <div class="panel-heading">
      <h3 class="panel-title"><i class="zmdi zmdi-refresh"></i> &nbsp; MIS DATOS</h3>
     </div>
     <div class="panel-body">
      <form action="<?php echo RUTA_URL ?>ajax/administradorAjax.php" class="FormularioAjax" method="POST" data-form="update" autocomplete="off">
          <fieldset>
           <legend><i class="zmdi zmdi-account-box"></i> &nbsp; Información personal</legend>
           <div class="container-fluid">
            <div class="row">
             <div class="col-xs-12">
              <div class="form-group label-floating">
              <label class="control-label">DNI/CEDULA *</label>
              <input pattern="[0-9-]{1,30}" class="form-control" type="text" name="txt_cedula" required="" maxlength="30" value="<?php echo $admin_data_x_id['AdminDNI']; ?>">
           </div>
             </div>
             <div class="col-xs-12 col-sm-6">
              <div class="form-group label-floating">
              <label class="control-label">Nombres *</label>
              <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="txt_nombre" required="" maxlength="30" value="<?php echo $admin_data_x_id['AdminNombre']; ?>">
           </div>
             </div>
             <div class="col-xs-12 col-sm-6">
           <div class="form-group label-floating">
              <label class="control-label">Apellidos *</label>
              <input pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,30}" class="form-control" type="text" name="txt_apellido" required="" maxlength="30" value="<?php echo $admin_data_x_id['AdminApellido']; ?>">
           </div>
             </div>
             <div class="col-xs-12 col-sm-6">
           <div class="form-group label-floating">
              <label class="control-label">Teléfono</label>
              <input pattern="[0-9+]{1,15}" class="form-control" type="text" name="txt_telefono" maxlength="15" value="<?php echo $admin_data_x_id['AdminTelefono']; ?>">
           </div>
             </div>
             <div class="col-xs-12">
           <div class="form-group label-floating">
              <label class="control-label">Dirección</label>
              <textarea name="txt_direccion" class="form-control" rows="2" maxlength="100"><?php echo $admin_data_x_id['AdminDireccion']; ?></textarea>
           </div>
             </div>
            </div>
           </div>
          </fieldset>
          <p class="text-center" style="margin-top: 20px;">
           <button type="submit" class="btn btn-success btn-raised btn-sm"><i class="zmdi zmdi-refresh"></i> Actualizar</button>
          </p>
          <input type="hidden" name="hdd_admin_cuenta_codigo" value="<?php echo $datos[2]; ?>">
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
