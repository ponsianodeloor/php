<?php namespace Models;
    class Estudiante{

        private $cnn;
        private $estudiante_id;
        private $estudiante_nombre;
        private $estudiante_edad;
        private $estudiante_promedio;
        private $estudiante_imagen;
        private $estudiante_seccion_id;
        private $estudiante_fecha_registro;

        public function __construct(){
            $this->cnn = new Conexion();
        }

        public function set($atributo, $contenido){
            $this->$atributo = $contenido;
        }
        public function get($atributo){
            return $this->$atributo;
        }

        public function listar(){
            $sql = "SELECT t1.*, t2.seccion as nombre_seccion FROM estudiantes t1
                    INNER JOIN secciones t2 ON t1.estudiante_seccion_id = t2.seccion_id";
            $datos = $this->cnn->consultaRetorno($sql);

            return $datos;
        }

        public function registrar(){
            $sql = "INSERT INTO estudiantes(
                estudiante_nombre,
                estudiante_edad,
                estudiante_promedio,
                estudiante_imagen,
                estudiante_seccion_id,
                estudiante_fecha_registro)

                VALUES(
                    '{$this->estudiante_nombre}',
                    '{$this->estudiante_edad}',
                    '{$this->estudiante_promedio}',
                    '{$this->estudiante_imagen}',
                    '{$this->estudiante_seccion_id}',
                    NOW()
                );
            ";
           $this->con->consultaSimple($sql);
        }

        public function eliminar(){
            $sql = "DELETE FROM estudiantes WHERE estudiante_id = '{$this->estudiante_id}'";
            $this->consultaSimple($sql);
        }

        public function editar(){
            $sql = "UPDATE estudiantes SET
                    estudiante_nombre = '{$this->estudiante_nombre}',
                    estudiante_edad = '{$this->estudiante_edad}',
                    estudiante_promedio = '{$this->estudiante_promedio}',
                    estudiante_seccion_id = '{$this->estudiante_seccion_id}'
                    WHERE estudiante_id = '{$this->estudiante_id}'";
            $this->consultaSimple($sql);
        }

        public function view(){
            $sql = "SELECT t1.*, t2.seccion as nombre_seccion FROM estudiantes t1 INNER JOIN secciones t2
                    ON t1.estudiante_seccion_id = t2.seccion_id WHERE t1.estudiante_id = '{$this->estudiante_id}'";
            $datos = $this->cnn->consultaRetorno($sql);
            $row = mysqli_fetch_assoc($datos);

            return $row;
        }
    }
?>
