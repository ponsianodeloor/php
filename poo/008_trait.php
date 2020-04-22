<?php
    trait PersonaTrait{
        public $nombre;

        public function mostrarNombre(){
            echo $this->nombre;
        }

        public abstract function asignarNombre($nombre);
    }

    trait Trabajador{
        protected function mensaje(){
            echo " y soy un trabajador";
        }
    }

    class Persona{
        use PersonaTrait, Trabajador;

        public function asignarNombre($nombre){
            $this->nombre = $nombre. self::mensaje();
        }
    }

    $objPersona = new Persona();
    $objPersona->asignarNombre("Ponsiano");
    echo $objPersona->nombre;
    echo $objPersona->mostrarNombre();
    //echo $objPersona->mensaje();
?>