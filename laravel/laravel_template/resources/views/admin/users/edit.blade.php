<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 </head>
 <body>
  <h1 style="text-align:center; margin:50px 0;">Editar Usuario</h1>
  <?php echo Form::model($user, ['action' => ['AdminUsersController@update', $user->id], 'method' => 'PATCH']) ?>
  <table class="table">
   <tr>
    <td colspan="2" align="center">
     <img src="{{ asset('image')}}/{{$user->user_ruta_img ? $user->user_ruta_img : 'usuario-registrados.png'}}" alt="" width="100px">
    </td>
   </tr>
   <tr>
    <td>Rol</td>
    <td>
      <?php
      $rols_array = array('-1'=>'seleccionar');
      foreach ($rols as $row_rols) {
        $rols_array += [$row_rols['id'] => $row_rols['rol_nombre']];
      }
      ?>
      <?php echo Form::select('rol_id', $rols_array, $user->role_id);
      ?>
    </td>
   </tr>
   <tr>
    <td>Nombre</td>
    <td><?php echo Form::text('name', $user->name); ?></td>
   </tr>
   <tr>
    <td>Email</td>
    <td>{!! Form::text('email', $user->email); !!}</td>
   </tr>
   <tr>
    <td ><?php echo Form::submit('Guardar Usuario'); ?></td>
    <td ><?php echo Form::reset('Limpiar formulario'); ?></td>
   </tr>
  </table>

 <?php echo csrf_field() ?>
 <?php echo Form::close() ?>

{!! Form::open(['method'=>'DELETE', 'action'=>['AdminUsersController@destroy', $user->id]]) !!}
 <input type="submit" name="Enviar" value="Eliminar Usuario">
 {{csrf_field()}}
{!! Form::close() !!}

 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 </body>
</html>
