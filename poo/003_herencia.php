<?php

    class Vehiculo{
        public $motor = false;
        public $marca;
        public $color;

        //Metodos
        public function estado(){
            if ($this->motor) {
                echo "El motor esta encendido<br>";
            }else{
                echo "El motor esta apagado<br>";
            }
        }

        public function encender(){
            if ($this->motor) {
                echo "Cuidado el motor ya esta encendido<br>";
            } else {
                echo "El motor ahora esta encendido<br>";
                $this->motor = true;
            }
            
        }
    }

    $objVehiculo = new Vehiculo();
    $objVehiculo->estado();
    $objVehiculo->encender();
    $objVehiculo->estado();
    echo "<hr>";

    class Moto extends Vehiculo{
        public function estadoMoto(){
            $this->estado();
        }
    }
    $objMoto = new Moto();
    $objMoto->estadoMoto();
    echo "<hr>";

    class CuatriMoto extends Moto{

    }
    $objCuatrimoto = new Cuatrimoto();
    $objCuatrimoto->estado();

?>