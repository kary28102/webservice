<?php

    require 'Alumnos.php';

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        // Manejar petición GET
        $alumnos = Alumnos::getAllOT();
        if($alumnos){
            $datos["estado"] = 1;
            $datos["alumnos"] = $alumnos;

            print json_encode($datos);
        }else{
            print json_encode(array("estado" => 2, "mensaje" => "Ha ocurrido un error"));
        }
       
    }

?>