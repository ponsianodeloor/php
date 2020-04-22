<?php

    define('DS', DIRECTORY_SEPARATOR);
    define('ROOT', realpath(dirname(__FILE__)), DS);

    require_once "Config/Autoload.php";
    Config\Autoload::run();
    new Config\Request();

    /*
    //new Models\Estudiante();
    $est = new Models\Estudiante();
    $est->set("estudiante_id", 1);
    $datos = $est->view();
    print $datos['estudiante_nombre'];
    //new Models\Seccion();
    */
?>
