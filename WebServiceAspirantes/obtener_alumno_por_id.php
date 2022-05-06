<?php

    require 'Alumnos.php';
    require 'Administrador.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener parámetro idalumno
            $body = json_decode(file_get_contents("php://input"), true);
            // Tratar retorno
          if('user_type'==4){
            $retorno = Alumnos::getById(
                $body['u_email'],
                $body['u_passwd']);}
         if('user_type'==1){
            $retorno = Administrador::getById(  
                $body['u_email'],
                $body['u_passwd']);
           }

                if($retorno){
                    $json_string = json_encode(array("estado" => 1,"mensaje" => "Creacion correcta"));
		            echo $json_string;
                }else{
                    print json_encode(array("estado" => 2, "mensaje" => "Ha ocurrido un error"));
                }
   
    }

?>
