<?php
 ini_set('memory_limit', '64M');

 const SERVER = "localhost";
 const DB = "apptics_agua_potable";
 const USER = "postgres";
 const PASS = "postgres";
 const PORT = "5433";

 /**
  * [SGBD description
  * Variable de conexion a la DB para el modelo Principal core/MainModel.php]
  * @var string
  */
 const SGBD = "pgsql:host=".SERVER.";dbname=".DB;

 /**
  * [METHOD description encriptacion de datos]
  * @var string
  */
 const METHOD = 'AES-256-CBC';
 const SECRET_KEY = '$APPTICSPHPMVCGULL@2020';
 const SECRET_IV = '120641';

/**
 * [Base description clase para conexion a DataBase]
 */
 class Base extends PDO
 {
     //nombre base de datos
     public $dbname = DB;
     //nombre servidor
     public $host = SERVER;
     //nombre usuarios base de datos
     public $user = USER;
     //password usuario
     public $pass = PASS;
     //puerto postgreSql
     public $port = PORT;

     public $dbh;

     //creamos la conexión a la base de datos prueba
     public function __construct()
     {
         try {
             parent::__construct(
                 'pgsql:host='.$this->host.';port='.$this->port.';dbname='.$this->dbname,
                 $this->user,
                 $this->pass                 
             );
             $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $this->dbh = $this;
         } catch (PDOException $e) {
             echo  $e->getMessage();
         }
     }
     //función para cerrar una conexión pdo
     public function close_con()
     {
         $this->dbh = null;
     }
 }
