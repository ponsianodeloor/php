<table border="1">
 <tr>
   <td>Categoria</td>
   <td>Nombre producto</td>
   <td>descripcion</td>
   <td>Precio</td>

 </tr>
<?php foreach ($productos as $row_producto): ?>
<tr>
 <td>
  {{$row_producto->category->nombre}}
 </td>
 <td>
  {{$row_producto->nombre}}
 </td>
 <td>
  {{$row_producto->descripcion}}
 </td>
 <td>
  {{$row_producto->precio}}
 </td>
</tr>
<?php endforeach; ?>
</table>
