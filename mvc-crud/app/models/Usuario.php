<?php

 class Usuario{
  private $db;

  function __construct(){
   $this->db = new Base;
  }

  function obtenerUsuario($usuario_id){
   $this->db->query("SELECT * FROM usuarios WHERE usuario_id = :usuario_id");
   $this->db->bind(':usuario_id', $usuario_id);

   $resultados = $this->db->registro();
   return $resultados;
  }

  function obtenerUsuarios(){
   $this->db->query("SELECT * FROM usuarios");
   $resultados = $this->db->registros();
   return $resultados;
  }

  function agregarUsuario($datos){
   $this->db->query('INSERT INTO usuarios(usuario_nombre, usuario_email, usuario_telefono) VALUES(:nombre, :email, :telefono)');

   //vincular valores
   $this->db->bind(':nombre', $datos['usuario_nombre']);
   $this->db->bind(':email', $datos['usuario_email']);
   $this->db->bind(':telefono', $datos['usuario_telefono']);

   //ejecutar
   if ($this->db->execute()) {
    return true;
   }else {
    return false;
   }
  }//function agregarUsuario($datos){

  function editarUsuario($datos){
   $this->db->query('UPDATE usuarios SET usuario_nombre = :usuario_nombre, usuario_email = :usuario_email, usuario_telefono = :usuario_telefono
    WHERE usuario_id = :usuario_id');

   //vincular valores
   //echo $datos['usuario_id'];
   $this->db->bind(':usuario_id', $datos['usuario_id']);
   $this->db->bind(':usuario_nombre', $datos['usuario_nombre']);
   $this->db->bind(':usuario_email', $datos['usuario_email']);
   $this->db->bind(':usuario_telefono', $datos['usuario_telefono']);

   //ejecutar
   if ($this->db->execute()) {
    return true;
   }else {
    return false;
   }
  }//function editarUsuario($datos)

  function eliminarUsuario($datos){
   $this->db->query('DELETE FROM usuarios WHERE usuario_id = :usuario_id');

   //vincular valores
   $this->db->bind(':usuario_id', $datos['usuario_id']);

   //ejecutar
   if ($this->db->execute()) {
    return true;
   }else {
    return false;
   }
  }//function editarUsuario($datos)


 }

?>
