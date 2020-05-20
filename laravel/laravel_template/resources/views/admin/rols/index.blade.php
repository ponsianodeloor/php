<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  <meta charset="utf-8">
  <title>Rols</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 </head>
 <body>
  <h1>Esta es la pagina de Roles</h1>
  <table border="1">
   <tr>
     <td>Acciones</td>
     <td>Rol</td>
     <td>Middleware</td>
     <td>Fecha creacion</td>
     <td>Fecha ultima Actualizacion</td>
   </tr>
   <?php if ($rols): ?>
    <?php foreach ($rols as $row_rols): ?>
    <tr>
      <td>
       <a href="{{route('rols.edit', $row_rols->id)}}">Actualizar</a>
      </td>
    <td>
        {{$row_rols->rol_nombre}}
    </td>
    <td><?php echo $row_rols->rol_middleware ?></td>
    <td><?php echo $row_rols->created_at ?></td>
    <td><?php echo $row_rols->updated_at ?></td>
    </tr>
    <?php endforeach; ?>
   <?php endif; ?>
  </table>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
 </body>
</html>
