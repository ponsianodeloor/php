<?php
    abstract class Molde{
        abstract public function ingresarNombre($nombre);
        abstract public function obtenerNombre();

        /*
        public static function mensaje($mensaje){
            echo $mensaje;
        }
        */
    }

    class Persona extends Molde{
        private $mensaje = "Hola pipol ";
        private $nombre;

        public function mostrar(){
            echo $this->mensaje;
        }

        public function ingresarNombre($nombre){
            $this->nombre = $nombre;
        }
        public function obtenerNombre(){
            echo $this->nombre;
        }
    }

    $objPersona = new Persona();
    $objPersona->mostrar();
    $objPersona->ingresarNombre('Ponsiano');
    $objPersona->obtenerNombre();

    //Molde::mensaje('Helow deja el show'); //segun las clases abstract no pueden ser intanciadas y esto no es una instancia

    class PersonaAbstract extends Molde{
        private $nombre;
        public function ingresarNombre($nombre){
            $this->nombre = $nombre;
        }
        public function obtenerNombre(){
            echo $this->nombre . " esto es abstracto";
        }
    }

    $objPersonaAbstract = new PersonaAbstract();
    $objPersonaAbstract->ingresarNombre('Pansoleo');
    $objPersonaAbstract->obtenerNombre();
?>