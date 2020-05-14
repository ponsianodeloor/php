<?php require RUTA_APP.'/views/incl/header.php'; ?>
<a href="<?php echo RUTA_URL; ?>/" class="btn btn-light"> <i class="fa fa-backward"></i> Volver </a>
<div class="card card-body bg-ligth mt-5">
 <h2>Eliminar Rol</h2>
 <form action="<?php echo RUTA_URL; ?>/rols/eliminar/<?php echo $datos['rol_id']; ?>" method="post">

  <div class="form-group">
   <label for="nombre">Nombre: <sup>*</sup> </label>
   <input type="text" class="form-control form-control-lg" name="txt_rol" value="<?php echo $datos['rol'] ?>" readonly>
  </div>

  <div class="form-group">
   <label for="email">Email: <sup>*</sup> </label>
   <input type="text" class="form-control form-control-lg" name="txt_rol_ruta" value="<?php echo $datos['rol_ruta'] ?>" readonly>
  </div>

  <input type="submit" class="btn btn-success" name="" value="Eliminar Rol">

 </form>
</div>
<?php require RUTA_APP.'/views/incl/footer.php'; ?>
