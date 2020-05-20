<?php
 //clase para conectarse a la bd por PDO
 class Base{
  private $host = DB_HOST;
  private $db_nombre = DB_NOMBRE;
  private $usuario = DB_USUARIO;
  private $password = DB_PASS;

  private $dbh;
  private $stmt;
  private $error;

  public function __construct(){
   //configurar conexion
   $dsn = 'mysql:host='.$this->host.';dbname='.$this->db_nombre;
   $opciones = array(
    PDO::ATTR_PERSISTENT=>true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
   );

   //crear una instancia
   try{
    $this->dbh = new PDO($dsn, $this->usuario, $this->password, $opciones);
    $this->dbh->exec('set names utf8');
   }catch(PDOException $e){
    $this->error = $e->getMessage();
    echo $this->error;
   }
  }//function __construct

  //preparamos la consulta
  public function query($sql){
   $this->stmt = $this->dbh->prepare($sql);
  }

  //vinculamos la consulta con bind
  public function bind($parametro, $valor, $tipo = null){
   if (is_null($tipo)) {
    switch (true) {
     case is_int($valor):
      $tipo = PDO::PARAM_INT;
     break;
     case is_bool($valor):
      $tipo = PDO::PARAM_BOOL;
     break;
     case is_null($valor):
      $tipo = PDO::PARAM_NULL;
     break;
     default:
      $tipo = PDO::PARAM_STR;
     break;
    }//switch (true) {
   }//(is_null($tipo)) {
   $this->stmt->bindValue($parametro, $valor, $tipo);
  }// public function bind($parametro, $valor, $tipo = null){

  //esta funcion ejecuta la consulta
  public function execute(){
   return $this->stmt->execute();
  }//public function execute(){

  //obtener un solo registro fetch
  public function registro(){
   $this->execute();
   return $this->stmt->fetch(PDO::FETCH_OBJ);
  }

  //obtener los registros fetchAll
  public function registros(){
   $this->execute();
   return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }

  //obtener cantidad de filas con el metodo rwoCount
  public function rowCount(){
   return $this->stmt->rowCount();
  }


 }//class Base
?>
