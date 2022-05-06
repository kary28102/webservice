<?php

    require 'Alumnos.php';
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener parámetro idalumno
            $body = json_decode(file_get_contents("php://input"), true);
            // Tratar retorno
            $retorno = Alumnos::getByIdCorreo($body['u_email']);

                if($retorno){
                    $json_string = json_encode(array("estado" => 1,"mensaje" => "El correo ingresado ya esta registrado"));
		            echo $json_string;
                }else{
                    print json_encode(array("estado" => 2, "mensaje" => "Ha ocurrido un error"));
                }
        
    }

?>