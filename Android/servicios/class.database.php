<?php
ini_set('memory_limit', '64M');
class Database extends PDO
{
	//nombre base de datos
	public $dbname = "appticscom_medcalendar";
	//nombre servidor
	public $host = "localhost";
	//nombre usuarios base de datos
	public $user = "appticscom_userm";
	//password usuario
	public $pass = 'MedCalendar.com1900QP';
	//puerto postgreSql
	public $dbh;

	//creamos la conexión a la base de datos prueba
	public function __construct()
	{
	    try {
			parent::__construct(
                'mysql:host='.$this->host.';dbname='.$this->dbname,$this->user, $this->pass,
                array(
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . 'utf8',
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
