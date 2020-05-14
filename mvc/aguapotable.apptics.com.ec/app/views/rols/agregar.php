<?php require RUTA_APP.'/views/incl/header.php'; ?>
<a href="<?php echo RUTA_URL; ?>/" class="btn btn-light"> <i class="fa fa-backward"></i> Volver </a>
<div class="card card-body bg-ligth mt-5">
 <h2>Agregar Rol</h2>
 <form action="<?php echo RUTA_URL; ?>/rols/agregar" method="post">

  <div class="form-group">
   <label for="nombre">Rol: <sup>*</sup> </label>
   <input type="text" class="form-control form-control-lg" name="txt_rol" value="">
  </div>

  <div class="form-group">
   <label for="email">Rol ruta: <sup>*</sup> </label>
   <input type="text" class="form-control form-control-lg" name="txt_rol_ruta" value="">
  </div>

  <input type="submit" class="btn btn-success" name="" value="Agregar Rol">

 </form>
</div>
<?php require RUTA_APP.'/views/incl/footer.php'; ?>
