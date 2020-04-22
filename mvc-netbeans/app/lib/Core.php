<?php
 //mapear la url ingresada 
 //en el navegador 1 controlador 2 metodo 3 
 //parametro ejemplo /articulos/actualizar/4
 class Core{
  protected $controladorActual = 'paginas';
  protected $metodoActual = 'index';
  protected $parametros = [];


  public function __construct(){
   $url = $this->getUrl();
   // 0,1,2 -> 0 = controlador, 1 = metodoActual, 2 = parametros
   //print_r($this->getUrl());
   //buscar en controladores si el controlador existe en la url
   if (@@ file_exists('../app/controllers/'.ucwords($url[0]).'.php')) {
    //si existe se setea como controlador por defecto
    $this->controladorActual = ucwords($url[0]);

    //unset indice
    unset($url[0]);
   }
   //requerir el controladores
   require_once '../app/controllers/'.$this->controladorActual.'.php';
   $this->controladorActual = new $this->controladorActual;

   if (isset($url[1])) {
    //chequear la segunda parte de la url que seria el $metodoActual
    if (method_exists($this->controladorActual, $url[1])) {
     //chequeamos el metodo
     $this->metodoActual = $url[1];
     unset($url[1]);
    }
   }
   //echo @@ $this->metodoActual;

   //obtener los $parametros
   $this->parametros = $url?array_values($url):[];
   //llamar callback con parametros array
   call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);


  }

  public function getUrl(){
    //echo $_GET['url'];
    if (isset($_GET['url'])) {
     $url = rtrim($_GET['url'], '/');
     $url = filter_var($url,FILTER_SANITIZE_URL);
     $url = explode('/', $url);
     return $url;
    }
  }
 }

?>
