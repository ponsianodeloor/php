<!-- Content page -->
<div class="container-fluid">
 <div class="page-header">
   <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Usuarios <small>ADMINISTRADORES</small></h1>
 </div>
 <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse voluptas reiciendis tempora voluptatum eius porro ipsa quae voluptates officiis sapiente sunt dolorem, velit quos a qui nobis sed, dignissimos possimus!</p>
</div>

<div class="container-fluid">
 <ul class="breadcrumb breadcrumb-tabs">
    <li>
     <a href="<?php echo RUTA_URL; ?>admin/" class="btn btn-info">
      <i class="zmdi zmdi-plus"></i> &nbsp; NUEVO ADMINISTRADOR
     </a>
    </li>
    <li>
     <a href="<?php echo RUTA_URL; ?>admin_list/" class="btn btn-success">
      <i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE ADMINISTRADORES
     </a>
    </li>
    <li>
     <a href="<?php echo RUTA_URL; ?>admin-search/" class="btn btn-primary">
      <i class="zmdi zmdi-search"></i> &nbsp; BUSCAR ADMINISTRADOR
     </a>
    </li>
 </ul>
</div>
<?php
 include_once 'controller/AdministradorController.php';
 $administradorController = new AdministradorController;

 if (isset($_POST['txt_busqueda_admin'])) {
  $_SESSION['txt_busqueda_admin'] = $_POST['txt_busqueda_admin'];
 }

 if (isset($_POST['hdd_eliminar_busqueda_admin'])) {
  unset($_SESSION['txt_busqueda_admin']);
 }
?>
<?php if (!isset($_SESSION['txt_busqueda_admin']) && empty($_SESSION['txt_busqueda_admin'])): ?>
<div class="container-fluid">
 <form class="well" method="POST" action="" autocomplete="off">
  <div class="row">
   <div class="col-xs-12 col-md-8 col-md-offset-2">
    <div class="form-group label-floating">
     <span class="control-label">¿A quién estas buscando?</span>
     <input class="form-control" type="text" name="txt_busqueda_admin" required="">
    </div>
   </div>
   <div class="col-xs-12">
    <p class="text-center">
     <button type="submit" class="btn btn-primary btn-raised btn-sm"><i class="zmdi zmdi-search"></i> &nbsp; Buscar</button>
    </p>
   </div>
  </div>
 </form>
</div>
 <?php else: ?>

<div class="container-fluid">
 <form class="well" action="" method="POST">
  <p class="lead text-center">Su última búsqueda  fue <strong><?php echo $_SESSION['txt_busqueda_admin'] ?></strong></p>
  <div class="row">
   <input class="form-control" type="hidden" name="hdd_eliminar_busqueda_admin" value="1">
   <div class="col-xs-12">
    <p class="text-center">
     <button type="submit" class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-delete"></i> &nbsp; Eliminar búsqueda</button>
    </p>
   </div>
  </div>
 </form>
</div>

<!-- Panel listado de busqueda de administradores -->
<div class="container-fluid">
 <div class="panel panel-primary">
  <div class="panel-heading">
   <h3 class="panel-title"><i class="zmdi zmdi-search"></i> &nbsp; BUSCAR ADMINISTRADOR</h3>
  </div>
  <div class="panel-body">
   <!-- tabla en html-->
   <?php
    $pagina = explode("/", $_GET['views']);
    echo $administradorController->paginadorAdministradorController($pagina[1], 10, $_SESSION['usuario_privilegio_sbp'], $_SESSION['usuario_cuenta_codigo_sbp'], $_SESSION['txt_busqueda_admin']);
   ?>
  </div>
 </div>
</div>

<?php endif; ?>
