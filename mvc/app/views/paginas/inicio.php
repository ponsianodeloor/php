<?php require RUTA_APP.'/views/incl/header.php'; ?>
<?php
 echo "<h1>Prueba de carga de vista inicio</h1>";
 echo $datos['titulo'];
 echo "<p>".RUTA_APP."</p>";
 echo NOMBRE_SITIO;
 //print_r($datos['articulos']);
?>
<ul>
 <?php foreach ($datos['articulos'] as $rows_Articulo): ?>
  <li><?php echo 'id: '. $rows_Articulo->articulo_id.' '.$rows_Articulo->articulo_titulo; ?></li>
 <?php endforeach; ?>
</ul>
<?php require RUTA_APP.'/views/incl/footer.php'; ?>
