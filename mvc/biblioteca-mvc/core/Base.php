<?php
 const SERVER = "";
 const DB = "";
 const USER = "";
 const PASS = "";

 //SGBD Sistema Gestor de Base de Datos
 const SGBD = "mysql:host=".SERVER.";dbname=".DB;

 //Metodo para encriptacion en la base de datos es individual para cada proyecto una vez guardado no se debe cambiar
 //sirve para que en la url se muestre un has como modo de seguridad
 const METHOD = 'AES-256-CBC';
 const SECRET_KEY = '$APPTICSBIBLIOTECAPUBLICA@2020';
 const SECRET_IV = '120641';
?>
