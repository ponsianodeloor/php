<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  <meta charset="utf-8">
  <title></title>
 </head>
 <body>

  <table class="table table-hover">
      <thead>
       <th>
        Acciones
       </th>
       <th>
         Estado
       </th>
       <th>
         Nombre
       </th>
       <th>
         mail
       </th>
       <th>
         Creado
       </th>
       <th>
         Actualizado
       </th>
      </thead>
      <tbody>
       <?php foreach ($usuarios as $row_usuarios): ?>
       <tr>
        <td>
         <a href="{{url('users/'.$row_usuarios->id.'/edit')}}">Actualizar</a>
        </td>
        <td>{{$row_usuarios['status']}}</td>
        <td>{{$row_usuarios['name']}} </td>
        <td>{{$row_usuarios['email']}}</td>
        <td>{{$row_usuarios['creted_at']}}</td>
        <td>{{$row_usuarios['updated_at']}}</td>
        <td>

        </td>
       </tr>
       <?php endforeach; ?>
      </tbody>
     </table>
     {{ $usuarios->links() }}

 </body>
</html>
