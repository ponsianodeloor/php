<?php
 namespace App\Model;

 use App\Lib\Database;

 class UserModel{

  private $db = null;
  public function __CONSTRUCT(){
   $this->db = Database::StartUp();
  }
  public function obtener($id){

  }
  public function listar(){
    /* Los registros */
    $result =
        $this->db
             ->from('alumnos')
             ->fetchAll();
   return $result;
  }
  public function actualizar($id){

  }
  public function registrar(){

  }
  public function eliminar ($id){

  }
 }
?>
