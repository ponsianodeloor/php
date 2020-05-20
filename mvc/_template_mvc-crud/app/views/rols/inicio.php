<?php require RUTA_APP.'/views/incl/header.php'; ?>
<table class="table">
 <thead>
  <tr>
   <th>Id</th>
   <th>Rol</th>
   <th>Rol Ruta</th>
   <th>Acciones</th>
  </tr>
 </thead>
 <tbody>
  <?php foreach ($datos['rols'] as $row_Rols): ?>
   <tr>
    <td><?php echo $row_Rols->rol_id; ?></td>
    <td><?php echo $row_Rols->rol; ?></td>
    <td><?php echo $row_Rols->rol_ruta; ?></td>
    <td> <a href="<?php echo RUTA_URL; ?>/rols/editar/<?php echo  $row_Rols->rol_id; ?>">Editar</a> </td>
    <td> <a href="<?php echo RUTA_URL; ?>/rols/eliminar/<?php echo  $row_Rols->rol_id; ?>">Borrar</a> </td>


   </tr>
  <?php endforeach; ?>

 </tbody>

</table>


<?php require RUTA_APP.'/views/incl/footer.php'; ?>
