<?php

    require 'Alumnos.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Decodificando formato Json
        $body = json_decode(file_get_contents("php://input"), true);
        // Insertar Alumno
        $retorno = Alumnos::insert(
            $body['u_name'],
            $body['u_midname'],
            $body['u_lastname'],
            $body['u_foreign'],
            $body['u_passwd'],
            $body['u_email'],
            $body['u_status'],
            $body['user_type']);
        if ($retorno) {
            $alumno["estado"] = 1;		// cambio "1" a 1 porque no coge bien la cadena.
            $alumno["alumno"] = $retorno;
            // Enviar objeto json del alumno
            print json_encode($alumno);
        } else {
            $json_string = json_encode(array("estado" => 2,"mensaje" => "No se creo el registro"));
            echo $json_string;
        }
    }
?>