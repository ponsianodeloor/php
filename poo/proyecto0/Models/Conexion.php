<?php namespace Models;
    class Conexion{
        private $datos = array(
            "host" => "localhost",
            "user" => "appticscom_userm",
            "pass" => "MedCalendar.com1900QP",
            "db"   => "appticscom_medcalendar"
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
