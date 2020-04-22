<?php
    //Variables conexión.
$servidor = "localhost";
$usuario = "root";
$contrasena = "ponsiano";
$bd = "proyecto";

// Conexión
$conexion = new mysql($servidor, $usuario, $contrasena, $bd, 3386);

// Comprobamos conxexión
if ($conexion->connect_error) {
    exit("Fallo al conectar a MySQL: " . $conexion->connect_error);
}


$sentencia = $conexion->query("SELECT * FROM estudiantes");

//Comprobar algun error al consultar nuestra consulta.
if(!$sentencia) {
   //Mensaje de error
   printf("Error consulta: %s\n" . $conexion->error);
}

//Total registros.
$total_num_rows = $sentencia->num_rows;

//Comprobamos existencia de registros.
if ($total_num_rows > 0) {
    //Recuperamos una fila de resultados como un array asociativo.
    while ($row = $sentencia->fetch_assoc()) {

        //Ya podemos trabajos con nuestros datos.
        echo $row['estudiante_nombre'];
        #etc.
    }

} else {
    echo "0 resultados encontrados";
}


//Cerramos conexión.
$conexion->close();

?>
