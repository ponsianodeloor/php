<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  <meta charset="utf-8">
  <title>Users</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 </head>
 <body>
  <h1>Esta es la pagina de usuarios</h1>
  <table border="1">
   <tr>
     <td>Acciones</td>
     <td>Rol</td>
     <td>Foto</td>
     <td>Usuario</td>
     <td>Email</td>
     <td>Fecha creacion</td>
     <td>Fecha ultima Actualizacion</td>
   </tr>
   <?php if ($users): ?>
    <?php foreach ($users as $row_users): ?>
    <tr>
      <td>
       <a href="{{route('users.edit', $row_users->id)}}">Actualizar</a>
      </td>
    <td>
      <?php if ($row_users->rol_id): ?>
        {{$row_users->rol->rol_nombre}}
      <?php endif; ?>
    </td>
    <td>
     <?php // echo $row_users->user_ruta_img ?>
     <?php if ($row_users->user_foto_ruta != ""): ?>
      <img src="{{ asset('image')}}/{{$row_users->user_foto_ruta}}" class="imagenCabecera" alt="" width="50px">
     <?php endif; ?>
    </td>
    <td>{{$row_users->name}}</td>
    <td><?php echo $row_users->email ?></td>
    <td><?php echo $row_users->created_at ?></td>
    <td><?php echo $row_users->updated_at ?></td>
    </tr>
    <?php endforeach; ?>
   <?php endif; ?>
  </table>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 </body>
</html>
