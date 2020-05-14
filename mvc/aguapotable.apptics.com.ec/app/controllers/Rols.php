<?php
 class Rols extends Controlador{
   
  public function __construct(){
   $this->rolModelo = $this->modelo('Rol');
  }

  public function index(){ //este metodo tiene que estar en todos los controladores ya que es el que esta por defecto

   $rols = $this->rolModelo->getRows();
   $datos = [
    'rols' => $rols
   ];
   $this->vista('rols/inicio', $datos);
  }

  public function agregar(){
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
     'rol' => trim($_POST['txt_rol']),
     'rol_ruta' => trim($_POST['txt_rol_ruta']),
    ];

    if ($this->rolModelo->addData($datos)) {
     redireccionar('/rols');
    }else {
     die('Algo salio mal');
    }
   }else {
    $datos =[
     'txt_rol'=>'',
     'txt_rol_ruta'=>'',
    ];
    $this->vista('rols/agregar', $datos);
   }
  }//public function agregar(){

  public function editar($rol_id){
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = [
     'rol_id' => $rol_id,
     'rol' => trim($_POST['txt_rol']),
     'rol_ruta' => trim($_POST['txt_rol_ruta']),
    ];

    if ($this->rolModelo->editDataId($datos)) {
     redireccionar('/');
    }else {
     die('Algo salio mal');
    }
   }else {

    //obtener informacion de usuario desde el modelo
    $rol = $this->rolModelo->getRowId($rol_id);

    $datos =[
     'rol_id' => $rol->rol_id,
     'rol'=>$rol->rol,
     'rol_ruta'=>$rol->rol_ruta,
    ];
    $this->vista('rols/editar', $datos);
   }
  }//public function editar($usuario_id){

   public function eliminar($rol_id){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $datos = [
      'rol_id' => $rol_id
     ];

     if ($this->rolModelo->deleteDataId($datos)) {
      redireccionar('/');
     }else {
      die('Algo salio mal');
     }
    }else {

     //obtener informacion de usuario desde el modelo
     $rol = $this->rolModelo->getRowId($rol_id);

     $datos =[
      'rol_id' => $rol->rol_id,
      'rol'=>$rol->rol,
      'rol_ruta'=>$rol->rol_ruta,
     ];
     $this->vista('rols/eliminar', $datos);
    }
   }


 }
?>
