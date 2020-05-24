<?php
 include_once 'core/config.php';
 //include 'views/plantilla.php';
 include_once 'controller/ViewsController.php';

 $view_plantilla = new ViewsController();
 $view_plantilla->obtenerPlantillaController();
?>
