<?php
require_once("class.database_pgsql.php");
date_default_timezone_set("America/Guayaquil");
setlocale(LC_MONETARY, 'en_US'); //echo money_format('%i', $number) . "\n";
$fecha_system = date('Y-m-d');
$hora_system  = date('H:i:s');
$fecha_hora_system = date("Y-m-d H:i:s");

class Users extends Database
{
	function __construct(){
                parent::__construct();
    }

	function execSQL($sql){
		$this->dbh->exec($sql);
	}
	function getRows($sql){
                $st = $this->dbh->prepare($sql);
                $st->execute();
                return $st->fetchAll();
 }
}//Class
