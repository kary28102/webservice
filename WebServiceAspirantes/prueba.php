<?php

    require 'Alumnos.php';
    $docs_subidos=null;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Decodificando formato Json
        $body = json_decode(file_get_contents("php://input"), true);
        // Insertar Alumno
        $id=$body['user_id'];
        $retorno = Alumnos::getPrueba(
            $id,
            $body['a_gender'],
            $body['a_birthday'],
            $body['a_phonecode'],
            $body['a_phonenumber'],
            $body['a_celcode'],
            $body['a_celnumber'],
            $body['fktalla'],
            $body['a_program'],
            $body['seat_id'],
            $body['speciality_id'],
            $body['area_id'],
            $body['a_status'],
            $docs_subidos,
            $body['rfc'],
            $id,
            $body['abg_hasdegree'],
            $body['abg_degree'],
            $body['abg_spdegree'],
            $body['abg_average'],
            $body['abg_datedegree'],
            $body['abg_rescomplete'],
            $body['aspirant_institution_id'],
            $body['aspirant_opdegree_id'],
            $id,
            $body['aa_neighborhood'],
            $body['aa_postcode'],
            $body['aa_streetaddr'],
            $body['town_id'],
            $body['state_id'],
            $body['country_id']);
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
