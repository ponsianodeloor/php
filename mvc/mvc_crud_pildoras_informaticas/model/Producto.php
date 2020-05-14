<?php
 class Producto{
  private $db;
  private $productos;

  public function __construct(){
   require_once("model/Conexion.php");
   $this->db = Conectar::conexion();
   $this->productos = array();
  }

  public function getProductos(){
   $consulta = $this->db->query("SELECT * from productos");
   while($filas = $consulta->fetch(PDO::FETCH_ASSOC)){
    $this->productos[] = $filas ;
   }
   return $this->productos;
  }
 }
?>
