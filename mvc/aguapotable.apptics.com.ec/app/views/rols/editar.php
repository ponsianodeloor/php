<?php require RUTA_APP.'/views/incl/header.php'; ?>
<a href="<?php echo RUTA_URL; ?>/" class="btn btn-light"> <i class="fa fa-backward"></i> Volver </a>
<div class="card card-body bg-ligth mt-5">
 <h2>Editar Usuarios</h2>
 <form action="<?php echo RUTA_URL; ?>/rols/editar/<?php echo $datos['rol_id']; ?>" method="post">

  <div class="form-group">
   <label for="nombre">Nombre: <sup>*</sup> </label>
   <input type="text" class="form-control form-control-lg" name="txt_rol" value="<?php echo $datos['rol'] ?>">
  </div>

  <div class="form-group">
   <label for="email">Email: <sup>*</sup> </label>
   <input type="text" class="form-control form-control-lg" name="txt_rol_ruta" value="<?php echo $datos['rol_ruta'] ?>">
  </div>

  <input type="submit" class="btn btn-success" name="" value="Editar Rol">

 </form>
</div>
<?php require RUTA_APP.'/views/incl/footer.php'; ?>
