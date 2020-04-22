<?php require RUTA_APP.'/views/incl/header.php'; ?>
<table class="table">
 <thead>
  <tr>
   <th>Id</th>
   <th>Nombre</th>
   <th>Email</th>
   <th>Telefono</th>
   <th>Acciones</th>
  </tr>
 </thead>
 <tbody>
  <?php foreach ($datos['usuarios'] as $row_Usuarios): ?>
   <tr>
    <td><?php echo $row_Usuarios->usuario_id; ?></td>
    <td><?php echo $row_Usuarios->usuario_nombre; ?></td>
    <td><?php echo $row_Usuarios->usuario_email; ?></td>
    <td><?php echo $row_Usuarios->usuario_telefono; ?></td>
    <td> <a href="<?php echo RUTA_URL; ?>/paginas/editar/<?php echo  $row_Usuarios->usuario_id; ?>">Editar</a> </td>
    <td> <a href="<?php echo RUTA_URL; ?>/paginas/eliminar/<?php echo  $row_Usuarios->usuario_id; ?>">Borrar</a> </td>


   </tr>
  <?php endforeach; ?>

 </tbody>

</table>


<?php require RUTA_APP.'/views/incl/footer.php'; ?>
