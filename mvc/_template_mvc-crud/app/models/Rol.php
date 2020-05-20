<?php

 class Rol{
  private $db;

  function __construct(){
   $this->db = new Base;
  }

  function getRowId($rol_id){
   $this->db->query("SELECT * FROM rols WHERE rol_id = :rol_id");
   $this->db->bind(':rol_id', $rol_id);

   $resultados = $this->db->registro();
   return $resultados;
  }

  function getRows(){
   $this->db->query("SELECT * FROM rols");
   $resultados = $this->db->registros();
   return $resultados;
  }

  function addData($datos){
   $this->db->query('INSERT INTO rols(rol, rol_ruta) VALUES(:rol, :rol_ruta)');

   //vincular valores
   $this->db->bind(':rol', $datos['rol']);
   $this->db->bind(':rol_ruta', $datos['rol_ruta']);

   //ejecutar
   if ($this->db->execute()) {
    return true;
   }else {
    return false;
   }
  }//function agregarUsuario($datos){

  function editDataId($datos){
   $this->db->query('UPDATE rols SET rol = :rol, rol_ruta = :rol_ruta
    WHERE rol_id = :rol_id');

   //vincular valores
   //echo $datos['usuario_id'];
   $this->db->bind(':rol_id', $datos['rol_id']);
   $this->db->bind(':rol', $datos['rol']);
   $this->db->bind(':rol_ruta', $datos['rol_ruta']);

   //ejecutar
   if ($this->db->execute()) {
    return true;
   }else {
    return false;
   }
  }//function editarUsuario($datos)

  function deleteDataId($datos){
   $this->db->query('DELETE FROM rols WHERE rol_id = :rol_id');

   //vincular valores
   $this->db->bind(':rol_id', $datos['rol_id']);

   //ejecutar
   if ($this->db->execute()) {
    return true;
   }else {
    return false;
   }
  }//function editarUsuario($datos)


 }

?>
