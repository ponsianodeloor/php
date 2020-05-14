<?php
 class User{
  private $db;
  private $users;

  public function __construct(){
   require_once("model/Conexion.php");
   $this->db = Conectar::conexion();
   $this->users = array();
  }

  public function getUsers(){
   $consulta = $this->db->query("SELECT * from users");
   while($filas = $consulta->fetch(PDO::FETCH_ASSOC)){
    $this->users[] = $filas ;
   }
   return $this->users;
  }
 }
?>
