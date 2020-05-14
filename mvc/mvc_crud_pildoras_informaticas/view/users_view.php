<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
  <meta charset="utf-8">
  <title></title>
 </head>
 <body>
  <table>
   <thead>
    <th>Usuario</th>
    <th>Email</th>
    <th>Fecha Creacion</th>
   </thead>

  <?php
  foreach ($users as $row_users) {
   echo "<tr>";
   echo "<td>".$row_users["user"]."</td>"."<td>".$row_users["user_email"]."</td>"."<td>".$row_users['user_create']."</td>";
   echo "</tr>";
  }
  ?>
  </table>
 </body>
</html>
