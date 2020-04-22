<?php namespace Models;
    class Conexion{
        private $datos = array(
            "host" => "localhost",
            "user" => "root",
            "pass" => "ponsiano",
            "db"   => "proyecto"
        );

        private $cnn;


        public function __construct(){
            //var_dump($this->datos);
            //echo $this->datos['host'];
            $this->cnn = new \mysqli(
                $this->datos['host'],
                $this->datos['user'],
                $this->datos['pass'],
                $this->datos['db']
            );
        }

        public function consultaSimple($sql){
            $this->cnn->query($sql);
        }

        public function consultaRetorno($sql){
            $datos = $this->cnn->query($sql);
            return $datos;
        }
    }

    $objConexion = new Conexion();
?>
