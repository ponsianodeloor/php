<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  <meta charset="utf-8">
  <title>Crear Usuario</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 </head>
 <body>
  <h1>Crear nuevo usuario</h1>
  <?php echo Form::open(['action' => 'AdminUsersController@store', 'method' => 'post', 'files'=>'true']) ?>
  <table border="1">
    <tr>
      <td>Rol</td>
      <td>
        <?php
        $rols_array = array('-1'=>'seleccionar');
        foreach ($rols as $row_rols) {
          $rols_array += [$row_rols['id'] => $row_rols['rol_nombre']];
        }
        ?>
        <?php echo Form::select('rol_id', $rols_array, '1', ['class' => 'form-control']);
        ?>
      </td>
    </tr>
    <tr>
    <td>Subir Foto</td>
      <td>

      <input type="file" name="file_foto_perfil" class="form-control">
      </td>
      </tr>
      <tr>
      <td>Nombre</td>
      <td>
      <?php echo Form::text('name', '', ['class' => 'form-control']);?>
      </td>
    </tr>
    <tr>
      <td>Email</td>
      <td>
      {!! Form::text('email', '', ['class' => 'form-control']); !!}
      </td>
    </tr>
    <tr>
    <td>Pass</td>
    <td><?php echo Form::password('password', ['class' => 'form-control']); ?></td>
   </tr>
   <tr>
    <td ><?php echo Form::submit('Guardar Usuario', ['class' => 'btn btn-primary']); ?></td>
    <td ><?php echo Form::reset('Limpiar formulario', ['class' => 'btn btn-primary']); ?></td>
   </tr>
  </table>

 <?php echo csrf_field() ?>
 <?php echo Form::close() ?>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

 </body>
</html>
