<?php
ini_set('memory_limit', '64M');
class Database extends PDO
{
	//nombre base de datos
	public $dbname = "apptics_agua_potable";
	//nombre servidor
	public $host = "localhost";
	//puerto postgreSql
	public $port = '5432';
	//nombre usuarios base de datos
	public $user = "postgres";
	//password usuario
	public $pass = 'postgres';

	public $dbh;

	//creamos la conexión a la base de datos prueba
	public function __construct()
	{
	    try {
			parent::__construct(
                'pgsql:host='.$this->host.';port='.$this->port.';dbname='.$this->dbname,$this->user, $this->pass,
                array(
                    //PDO::ATTR_INIT_COMMAND => 'SET NAMES ' . 'utf8',
                    PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
                    ));
			$this->dbh = $this;

	    } catch(PDOException $e) {
	        echo  $e->getMessage();
	    }
	}
	//función para cerrar una conexión pdo
	public function close_con()
	{
    	$this->dbh = null;
	}
}
?>
