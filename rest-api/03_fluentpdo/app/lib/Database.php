<?php
 namespace App\Lib;

 use PDO;
 use FluentPDO;


 class Database{
  public static function StartUp(){
   try
    {
        $pdo = new PDO('mysql:host=localhost;dbname=colegio;charset=utf8', 'root', 'ponsiano');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

       $fluent = new FluentPDO($pdo);
    }
    catch(Exception $e)
    {
        die($e->getMessage());
    }
  }
 }
?>
