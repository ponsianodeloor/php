<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  <meta charset="utf-8">
  <title></title>
 </head>
 <body>
  <h1>Editar el user: {{$user->user_name}}</h1>
<form action="../../users/{{$user->id}}" method="post">
 <table>
  <tr>
   <td>
    Status
   </td>
   <td>
    <select class="" name="status">
     <option value="inactivo" <?php if($user['status'] == "inactivo") echo "selected"; ?>>inactivo</option>
     <option value="activo" <?php if($user['status'] == "activo") echo "selected"; ?>>Activo</option>
    </select>
   </td>
  </tr>
  <tr>
   <td>
    Nombre del user
   </td>
   <td>
    <input type="text" name="name" value="{{$user->name}}">
   </td>
  </tr>
  <tr>
   <td>
    Email
   </td>
   <td>
    <input type="text" name="email" value="{{$user->email}}">
   </td>
  </tr>

  <tr>
   <td colspan="2" align="center">
    <input type="submit" name="Enviar" value="Actualizar">
    <input type="reset" name="Borrar" value="Limpiar campos">
   </td>
  </tr>
 </table>
 {{csrf_field()}}
 <input type="hidden" name="_method" value="PUT">
</form>

 </body>
</html>
