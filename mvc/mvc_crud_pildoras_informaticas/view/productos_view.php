<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  <meta charset="utf-8">
  <title></title>
 </head>
 <body>
  <table>
   <thead>
    <th>Nombre</th>
    <th>Precio</th>
   </thead>

  <?php
  foreach ($productos as $row_productos) {
   echo "<tr>";
   echo "<td>".$row_productos["producto"]."</td>"."<td>". $row_productos['producto_precio']."</td>";
   echo "</tr>";
  }
  ?>
  </table>
 </body>
</html>
