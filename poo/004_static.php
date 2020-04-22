<?php
    class Pagina{
        //atributos
        public $nombre = "Ponsiano De Loor";
        public static $url = "apptics.com.ec";
        public static $bienvenidas = "Siempre";

        //Metodos
        public function bienvenida(){
            echo " Bienvenido ". $this->nombre." a la pagina ". Pagina::$url; // esto es a que la variable static tiene que ser llamada desde la clase
        }

        public static function bienvenida2(){
            //echo "Bienvenidos a ".$this->nombre;  no podemos mostrar la variable que no es estatica
            echo "Bienvenidos ".Pagina::$bienvenidas; //variable estatica
        }
    }

    $objPagina = new Pagina();
    $objPagina->bienvenida();

    Pagina::bienvenida2();

    class Web extends Pagina{

    }
    Web::bienvenida2();
?>