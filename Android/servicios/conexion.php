<?php
$hostname='localhost';
$database='appticscom_medcalendar';
$username='root';
$password='ponsiano';

$conexion=new mysqli($hostname,$username,$password,$database);
if($conexion->connect_error){
    echo "El sitio web está experimentado problemas";
}
?>
