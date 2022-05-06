<?php

    require 'Alumnos.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Decodificando formato Json
        $body = json_decode(file_get_contents("php://input"), true);
        // Actualizar alumno
        $retorno = Alumnos::update(
            $body['a_gender'],
            $body['a_birthday'],
            $body['a_phonecode'],
            $body['a_phonenumber'],
            $body['a_celcode'],
            $body['a_celnumber'],
            $body['fktalla'],
            $body['a_program'],
            $body['speciality_id'],
            $body['area_id'],
            $body['rfc'],
            $body['abg_hasdegree'],
            $body['abg_degree'],
            $body['abg_spdegree'],
            $body['abg_average'],
            $body['abg_datedegree'],
            $body['aspirant_institution_id'],
            $body['aspirant_opdegree_id'],
            $body['aa_neighborhood'],
            $body['aa_postcode'],
            $body['aa_streetaddr'],
            $body['town_id'],
            $body['state_id'],
            $body['country_id'],
            $body['user_id']);

        if ($retorno) {
            $json_string = json_encode(array("estado" => '1',"mensaje" => "Actualizacion correcta"));
		    echo $json_string;
        }else{
            $json_string = json_encode(array("estado" => '2',"mensaje" => "No se actualizo el registro"));
		    echo $json_string;
        }
    }
    
?>
