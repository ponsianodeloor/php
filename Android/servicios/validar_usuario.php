<?php
include 'conexion.php';
$usu_usuario=$_POST['usuario'];
$usu_password=sha1(md5($_POST['password']));

//$usu_usuario="aroncal@gmail.com";
//$usu_password="12345678";

$sentencia=$conexion->prepare("SELECT * FROM usuarios
 WHERE usuario= '$usu_usuario' AND usuario_pass_md5_sha1= '$usu_password'");

$sentencia->execute();

$resultado = $sentencia->get_result();
if ($fila = $resultado->fetch_assoc()) {
         echo json_encode($fila,JSON_UNESCAPED_UNICODE);
}
$sentencia->close();
$conexion->close();
?>
