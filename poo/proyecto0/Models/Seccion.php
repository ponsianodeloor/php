<?php namespace Models;
    class Seccion{
        private $con;
        private $seccion_id;
        private $seccion;
        
        public function __construct(){
            $this->con = new Conexion();
        }

        public function set($atributo, $contenido){
            $this->$atributo = $contenido;
        }
        public function get($atributo){
            return $this->$atributo;
        }

        public function listar(){
            $sql = "SELECT * FROM secciones";
            $datos = $this->con->consultaRetorno($sql);
            return $datos;
        }

        public function insertar(){
            $sql = "INSERT INTO secciones(seccion) VALUES('{$this->seccion}')";
            $this->consultaSimple($sql);
        }

        public function eliminar(){
            $sql = "DELETE FROM secciones  WHERE seccion_id = '{$this->seccion_id}'";
            $this->consultaSimple($sql);
        }

        public function editar(){
            $sql = "UPDATE secciones SET seccion = '{$this->seccion}' WHERE seccion_id = '{$this->seccion_id}'";
            $this->consultaSimple($sql);
        }

        public function view(){
            $sql = "SELECT * FROM secciones WHERE seccion_id = '{$this->seccion_id}'";
            $datos = $this->con->consultaRetorno($sql);
            $row = mysqli_fetch_assoc($datos);
            return $datos;
        }
    }
?>