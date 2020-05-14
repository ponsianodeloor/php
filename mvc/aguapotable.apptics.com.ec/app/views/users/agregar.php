<?php require RUTA_APP.'/views/incl/header.php'; ?>
<a href="<?php echo RUTA_URL; ?>/" class="btn btn-light"> <i class="fa fa-backward"></i> Volver </a>
<div class="card card-body bg-ligth mt-5">
 <h2>Agregar Usuarios</h2>
 <form action="<?php echo RUTA_URL; ?>/users/agregar" method="post">

  <div class="form-group">
   <label for="nombre">Nombre: <sup>*</sup> </label>
   <input type="text" class="form-control form-control-lg" name="txt_nombre" value="">
  </div>

  <div class="form-group">
   <label for="email">Email: <sup>*</sup> </label>
   <input type="text" class="form-control form-control-lg" name="txt_email" value="">
  </div>

  <div class="form-group">
   <label for="telefono">Telefono: <sup>*</sup> </label>
   <input type="text" class="form-control form-control-lg" name="txt_telefono" value="">
  </div>

  <input type="submit" class="btn btn-success" name="" value="Agregar Usuario">

 </form>
</div>
<?php require RUTA_APP.'/views/incl/footer.php'; ?>
