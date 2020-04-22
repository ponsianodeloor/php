<?php
 class Paginas extends Controlador{
  public function __construct(){
   //echo "Controlador pagina cargar";
   //es una variable entre clases
   $this->articuloModelo = $this->modelo('Articulo');
  }

  public function index(){ //este metodo tiene que estar en todos los controladores ya que es el que esta por defecto
   $articulos = $this->articuloModelo->obtenerArticulos();

   $datos = [
    'titulo' => 'Bienvenidos a MVC',
    'articulos' => $articulos
   ];
   $this->vista('paginas/inicio', $datos);


  }

  public function articulo(){
   $this->vista('paginas/articulo');
  }

  public function actualizar($num_registro){
   echo $num_registro;
  }
 }
?>
