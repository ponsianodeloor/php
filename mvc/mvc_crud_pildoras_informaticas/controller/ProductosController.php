<?php
 require_once("model/Producto.php");

 $Producto = new Producto;
 $productos = $Producto->getProductos();

 require_once("view/productos_view.php");
?>
