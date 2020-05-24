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
  <?php foreach ($datos['users'] as $row_Usuarios): ?>
   <tr>
    <td><?php echo $row_Usuarios->user_id; ?></td>
    <td><?php echo $row_Usuarios->user_nombre; ?></td>
    <td><?php echo $row_Usuarios->user_email; ?></td>
    <td><?php echo $row_Usuarios->user_telefono; ?></td>
    <td>
     <a href="<?php echo RUTA_URL; ?>/users/editar/<?php echo  $row_Usuarios->user_id; ?>">Editar</a>
     <a href="<?php echo RUTA_URL; ?>/users/eliminar/<?php echo $row_Usuarios->user_id; ?>">Borrar</a>
     <a onclick="page_div('<?php echo RUTA_URL; ?>/users/editar/<?php echo  $row_Usuarios->user_id; ?>','#div_main');"><i class="icon-doc-text"></i><span>Editar</span></a>
    </td>
    <td>  </td>
    <td></td>


   </tr>
  <?php endforeach; ?>

 </tbody>

</table>
<?php require RUTA_APP.'/views/incl/footer.php'; ?>
