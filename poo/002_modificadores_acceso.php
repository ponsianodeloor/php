<?php
    class Facebook{
        //atributos
        public $nombre;
        public $edad;
        private $pass;

        //Metodos
        function __construct($nombre, $edad, $pass){
            $this->nombre = $nombre;
            $this->edad = $edad;
            $this->pass = $pass;
        }

        public function verInformacion(){
            echo "Nombre: ". $this->nombre. "<br>";
            echo "Edad: ". $this->edad. "<br>";
            $this->cambiarPass("yonose");
            echo "Pass: ". $this->pass. "<br>";
        }

        private function cambiarPass($pass){
            $this->pass = $pass;
        }
    }

    $objFacebook = new Facebook("Ponsiano De Loor", "30", "jajaja");
    $objFacebook->verInformacion();
    //$objFacebook->pass = "8888"; // es private y no se puede cambiar a no ser que el cambio se lo haga en la misma clase
    //$objFacebook->cambiarPass('4321');
    echo "<hr>";
    $objFacebook->verInformacion();

    //los metodos de tipo private no pueden ser accedidos a traves de los metodos
?>