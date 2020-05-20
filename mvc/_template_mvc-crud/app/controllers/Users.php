<?php
 class Users extends Controlador{
   
  public function __construct(){
   $this->userModelo = $this->modelo('User');
  }

  public function index(){ //este metodo tiene que estar en todos los controladores ya que es el que esta por defecto

   $users = $this->userModelo->obtenerUsuarios();
   $datos = [
    'users' => $users
   ];
   $this->vista('users/inicio', $datos);
  }

  public function agregar(){
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
     'user_nombre' => trim($_POST['txt_nombre']),
     'user_email' => trim($_POST['txt_email']),
     'user_telefono' => trim($_POST['txt_telefono']),
    ];

    if ($this->userModelo->agregarUsuario($datos)) {
     redireccionar('/');
    }else {
     die('Algo salio mal');
    }
   }else {
    $datos =[
     'txt_nombre'=>'',
     'txt_email'=>'',
     'txt_telefono'=>''
    ];
    $this->vista('users/agregar', $datos);
   }
  }//public function agregar(){

  public function editar($user_id){
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
     'user_id' => $user_id,
     'user_nombre' => trim($_POST['txt_nombre']),
     'user_email' => trim($_POST['txt_email']),
     'user_telefono' => trim($_POST['txt_telefono']),
    ];

    if ($this->userModelo->editarUsuario($datos)) {
     redireccionar('/');
    }else {
     die('Algo salio mal');
    }
   }else {

    //obtener informacion de usuario desde el modelo
    $user = $this->userModelo->obtenerUsuario($user_id);

    $datos =[
     'user_id' => $user->user_id,
     'user_nombre'=>$user->user_nombre,
     'user_email'=>$user->user_email,
     'user_telefono'=>$user->user_telefono
    ];
    $this->vista('users/editar', $datos);
   }
  }//public function editar($usuario_id){

   public function eliminar($user_id){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $datos = [
      'user_id' => $user_id
     ];

     if ($this->userModelo->eliminarUsuario($datos)) {
      redireccionar('/');
     }else {
      die('Algo salio mal');
     }
    }else {

     //obtener informacion de usuario desde el modelo
     $user = $this->userModelo->obtenerUsuario($user_id);

     $datos =[
      'user_id' => $user->user_id,
      'user_nombre'=>$user->user_nombre,
      'user_email'=>$user->user_email,
      'user_telefono'=>$user->user_telefono
     ];
     $this->vista('users/eliminar', $datos);
    }
   }


 }
?>
