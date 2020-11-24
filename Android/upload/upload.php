<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

    $imagen= $_POST['foto'];
    $nombre = $_POST['nombre'];

    // RUTA DONDE SE GUARDARAN LAS IMAGENES
    $path = "uploads/$nombre.png";

    $actualpath = "http://192.168.100.123/Dropbox/php/Android/$path";

    file_put_contents($path, base64_decode($imagen));

    echo "SE SUBIO EXITOSAMENTE";
}
