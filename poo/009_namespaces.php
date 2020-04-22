<?php
    //require_once('api/Models/persona.php');
    //require_once('api/Controller/personas_controller.php');

    //Models\Persona::hola();
    //Controller\Persona::hola();

    spl_autoload_register(function ($clase){
        $ruta = "api/".str_replace("\\", "/", $clase.".php");
        print $ruta;
        if (is_readable($ruta)) {
            require_once($ruta);
        } else {
            echo "El archivo no existe";
        }
        
    });
    Models\Persona::hola();
    Controller\personas_controller::hola();
?>