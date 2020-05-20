<?php

 class User{
  private $db;

  function __construct(){
   $this->db = new Base;
  }

  function obtenerUsuario($user_id){
   $this->db->query("SELECT * FROM users WHERE user_id = :user_id");
   $this->db->bind(':user_id', $user_id);

   $resultados = $this->db->registro();
   return $resultados;
  }

  function obtenerUsuarios(){
   $this->db->query("SELECT * FROM users");
   $resultados = $this->db->registros();
   return $resultados;
  }

  function agregarUsuario($datos){
   $this->db->query('INSERT INTO users(user_nombre, user_email, user_telefono) VALUES(:nombre, :email, :telefono)');

   //vincular valores
   $this->db->bind(':nombre', $datos['user_nombre']);
   $this->db->bind(':email', $datos['user_email']);
   $this->db->bind(':telefono', $datos['user_telefono']);

   //ejecutar
   if ($this->db->execute()) {
    return true;
   }else {
    return false;
   }
  }//function agregarUsuario($datos){

  function editarUsuario($datos){
   $this->db->query('UPDATE users SET user_nombre = :user_nombre, user_email = :user_email, user_telefono = :user_telefono
    WHERE user_id = :user_id');

   //vincular valores
   //echo $datos['usuario_id'];
   $this->db->bind(':user_id', $datos['user_id']);
   $this->db->bind(':user_nombre', $datos['user_nombre']);
   $this->db->bind(':user_email', $datos['user_email']);
   $this->db->bind(':user_telefono', $datos['user_telefono']);

   //ejecutar
   if ($this->db->execute()) {
    return true;
   }else {
    return false;
   }
  }//function editarUsuario($datos)

  function eliminarUsuario($datos){
   $this->db->query('DELETE FROM users WHERE user_id = :user_id');

   //vincular valores
   $this->db->bind(':user_id', $datos['user_id']);

   //ejecutar
   if ($this->db->execute()) {
    return true;
   }else {
    return false;
   }
  }//function editarUsuario($datos)


 }

?>
