<?php
 class Paginas extends Controlador{
  public function __construct(){
   $this->usuarioModelo = $this->modelo('Usuario');
  }

  public function index(){ //este metodo tiene que estar en todos los controladores ya que es el que esta por defecto

   $usuarios = $this->usuarioModelo->obtenerUsuarios();
   $datos = [
    'titulo' => 'Bienvenidos a MVC',
    'usuarios' => $usuarios
   ];
   $this->vista('paginas/inicio', $datos);
  }

  public function agregar(){
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
     'usuario_nombre' => trim($_POST['txt_nombre']),
     'usuario_email' => trim($_POST['txt_email']),
     'usuario_telefono' => trim($_POST['txt_telefono']),
    ];

    if ($this->usuarioModelo->agregarUsuario($datos)) {
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
    $this->vista('paginas/agregar', $datos);
   }
  }//public function agregar(){

  public function editar($usuario_id){
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
     'usuario_id' => $usuario_id,
     'usuario_nombre' => trim($_POST['txt_nombre']),
     'usuario_email' => trim($_POST['txt_email']),
     'usuario_telefono' => trim($_POST['txt_telefono']),
    ];

    if ($this->usuarioModelo->editarUsuario($datos)) {
     redireccionar('/');
    }else {
     die('Algo salio mal');
    }
   }else {

    //obtener informacion de usuario desde el modelo
    $usuario = $this->usuarioModelo->obtenerUsuario($usuario_id);

    $datos =[
     'usuario_id' => $usuario->usuario_id,
     'usuario_nombre'=>$usuario->usuario_nombre,
     'usuario_email'=>$usuario->usuario_email,
     'usuario_telefono'=>$usuario->usuario_telefono
    ];
    $this->vista('paginas/editar', $datos);
   }
  }//public function editar($usuario_id){

   public function eliminar($usuario_id){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $datos = [
      'usuario_id' => $usuario_id
     ];

     if ($this->usuarioModelo->eliminarUsuario($datos)) {
      redireccionar('/');
     }else {
      die('Algo salio mal');
     }
    }else {

     //obtener informacion de usuario desde el modelo
     $usuario = $this->usuarioModelo->obtenerUsuario($usuario_id);

     $datos =[
      'usuario_id' => $usuario->usuario_id,
      'usuario_nombre'=>$usuario->usuario_nombre,
      'usuario_email'=>$usuario->usuario_email,
      'usuario_telefono'=>$usuario->usuario_telefono
     ];
     $this->vista('paginas/eliminar', $datos);
    }
   }


 }
?>
