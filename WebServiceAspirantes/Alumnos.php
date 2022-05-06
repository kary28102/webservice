<?php

    require 'Database.php';

    class Alumnos{
        function __constructor(){
        }

        public static function getAll(){
            $consulta = "SELECT * FROM arsuser";
            try{
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute();

                return $comando->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                return false;
            }
        }

        public static function getById($correo,$pass){
            // Consulta de la tabla Alumnos
            $consulta = "SELECT u_id,u_name,u_midname,u_lastname,u_foreign,u_passwd,u_email,user_type FROM arsuser WHERE u_email = ? and u_passwd= ? and user_type=4";
            try {
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute(array($correo,$pass));
                // Capturar primera fila del resultado
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                return $row;
            } catch (PDOException $e) {
                // Aquí puedes clasificar el error dependiendo de la excepción
                // para presentarlo en la respuesta Json
                return -1;
            }
        }

        public static function update($a_gender,
                                      $a_birthday,
                                      $a_phonecode,
                                      $a_phonenumber,
                                      $a_celcode,
                                      $a_celnumber,
                                      $fktalla,
                                      $a_program,
                                      $speciality_id,
                                      $area_id,
                                      $rfc,
                                      $abg_hasdegree,
                                      $abg_degree,
                                      $abg_spdegree,
                                      $abg_average,
                                      $abg_datedegree,
                                      $aspirant_institution_id,
                                      $aspirant_opdegree_id,
                                      $aa_neighborhood,
                                      $aa_postcode,
                                      $aa_streetaddr,
                                      $town_id,
                                      $state_id,
                                      $country_id,
                                      $user_id){
            // Creando consulta UPDATE
            $consulta = "UPDATE aspirant 
                         INNER JOIN aspirant_academicbg ON aspirant.a_id = aspirant_academicbg.aspirant_id
                         INNER JOIN aspirant_addr ON aspirant.a_id = aspirant_addr.aspirant_id
                         SET a_gender='$a_gender',a_birthday='$a_birthday',a_phonecode='$a_phonecode',a_phonenumber='$a_phonenumber',a_celcode='$a_celcode',a_celnumber='$a_celnumber',fktalla=(SELECT idTalla FROM talla WHERE Descripcion = '$fktalla' LIMIT 1),a_program='$a_program',speciality_id=(SELECT s_id FROM speciality WHERE s_name = '$speciality_id'),area_id=(SELECT a_id FROM area WHERE a_name = '$area_id'),rfc='$rfc',abg_hasdegree='$abg_hasdegree',abg_degree='$abg_degree',abg_spdegree='$abg_spdegree',abg_average='$abg_average',abg_datedegree='$abg_datedegree',aspirant_institution_id=(SELECT ins_id FROM aspirant_institution WHERE ins_name = '$aspirant_institution_id'),aspirant_opdegree_id=(SELECT aod_id FROM aspirant_opdegree WHERE aod_option = '$aspirant_opdegree_id' LIMIT 1),aa_neighborhood='$aa_neighborhood',aa_postcode='$aa_postcode',aa_streetaddr='$aa_streetaddr',town_id=(SELECT t_id FROM asptown WHERE t_name = '$town_id' and state_id=(SELECT state_id FROM aspstate WHERE state_name = '$state_id')),state_id=(SELECT state_id FROM aspstate WHERE state_name = '$state_id'),country_id=(SELECT c_id FROM aspcountry WHERE c_name = '$country_id')
                         WHERE aspirant.user_id = '$user_id'";
            // Preparar la sentencia
            $comando= Database::getInstance()->getDb()->prepare($consulta);
            // Relacionar y ejecutar la sentencia
            $comando->execute(array($a_gender,
                                    $a_birthday,
                                    $a_phonecode,
                                    $a_phonenumber,
                                    $a_celcode,
                                    $a_celnumber,
                                    $fktalla,
                                    $a_program,
                                    $speciality_id,
                                    $area_id,
                                    $rfc,
                                    $abg_hasdegree,
                                    $abg_degree,
                                    $abg_spdegree,
                                    $abg_average,
                                    $abg_datedegree,
                                    $aspirant_institution_id,
                                    $aspirant_opdegree_id,
                                    $aa_neighborhood,
                                    $aa_postcode,
                                    $aa_streetaddr,
                                    $town_id,
                                    $state_id,
                                    $country_id,
                                    $user_id));
            return $comando;
        }

        public static function insert($nombres,$paterno,$materno,$foraneo,$pass,$correo,$status,$tipo){
            // Sentencia INSERT
            $comando = "INSERT INTO arsuser ( " .
                "u_name," .
                "u_midname," .
                "u_lastname," .
                "u_foreign," .
                "u_passwd," .
                "u_email," .
                "u_status," .
                " user_type)" .
                " VALUES( ?,?,?,?,?,?,?,?)";
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(array($nombres,$paterno,$materno,$foraneo,$pass,$correo,$status,$tipo));
        }

        public static function delete($idAlumno){
            // Sentencia DELETE
            $comando = "DELETE FROM registros WHERE idalumno=?";
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            return $sentencia->execute(array($idAlumno));
        }

        public static function getUsuarios($idAlumno){
            // Consulta de la tabla Alumnos
            $consulta = "SELECT u_id,
                                u_name,
                                u_midname,
                                u_lastname,
                                u_foreign,
                                u_email
                                FROM arsuser
                                WHERE u_email = ?";
            try {
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute(array($idAlumno));
                // Capturar primera fila del resultado
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                return $row;
            }catch (PDOException $e) {
            // Aquí puedes clasificar el error dependiendo de la excepción
            // para presentarlo en la respuesta Json
            return -1;
            }
        }

        public static function getAllP(){
            $consulta = "SELECT * FROM aspcountry";
            try{
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                return false;
            }
        }

        public static function getAllE(){
            $consulta = "SELECT state_name FROM aspstate";
            try{
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                return false;
            }
        }

        public static function getAllM(){
            $consulta = "SELECT state_id,t_name FROM asptown";
            try{
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                return false;
            }
        }

        public static function getAllI(){
            $consulta = "SELECT ins_name FROM aspirant_institution";
            try{
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                return false;
            }
        }

        public static function getAllOT(){
            $consulta = "SELECT aod_option FROM aspirant_opdegree";
            try{
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                return false;
            }
        }

        public static function getAllA(){
            $consulta = "SELECT a_name FROM area";
            try{
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                return false;
            }
        }

        public static function getAllEspe(){
            $consulta = "SELECT area_id ,s_name FROM speciality";
            try{
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute();
                return $comando->fetchAll(PDO::FETCH_ASSOC);
            }catch (PDOException $e){
                return false;
            }
        }

        public static function getDescripcion($idAlumno){
            // Consulta de la tabla Alumnos
            $consulta = "SELECT desc_esp
                                 FROM speciality
                                 WHERE s_name = ?";
            try {
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute(array($idAlumno));
                // Capturar primera fila del resultado
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                return $row;
            }catch (PDOException $e) {
                // Aquí puedes clasificar el error dependiendo de la excepción
                // para presentarlo en la respuesta Json
                return -1;
            }
        }

        public static function getTablaAspirant($idAlumno){
            // Consulta de la tabla Alumnos
            $consulta = "SELECT a_status,a_gender,a_birthday,s_name,area.a_name,Descripcion,aspirant.a_id,rfc,CONCAT(a_phonecode,  '', a_phonenumber) as telefono,CONCAT(a_celcode,  '', a_celnumber) as celular,a_program,1000jc 
                            FROM aspirant
                            INNER JOIN speciality ON aspirant.speciality_id = speciality.s_id
                            INNER JOIN talla ON aspirant.fktalla = talla.idTalla
                            INNER JOIN area ON aspirant.area_id = speciality.area_id AND speciality.area_id=area.a_id
                            WHERE aspirant.user_id = ?";
            try {
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute(array($idAlumno));
                // Capturar primera fila del resultado
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                return $row;
            }catch (PDOException $e) {
                // Aquí puedes clasificar el error dependiendo de la excepción
                // para presentarlo en la respuesta Json
                return -1;
            }
        }

        public static function getTablaAdd($idAlumno){
            // Consulta de la tabla Alumnos
            $consulta = "SELECT aa_neighborhood,aa_postcode,aa_streetaddr,c_name,t_name,state_name
                            FROM aspirant_addr
                            INNER JOIN asptown ON aspirant_addr.town_id=asptown.t_id AND aspirant_addr.state_id=asptown.state_id
                            INNER JOIN aspcountry ON aspirant_addr.country_id=asptown.country_id AND asptown.country_id = aspcountry.c_id
                            INNER JOIN aspstate ON aspirant_addr.state_id = aspstate.state_id 
                            WHERE aspirant_addr.aspirant_id = (SELECT a_id FROM aspirant WHERE user_id = ?)";
            try {
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute(array($idAlumno));
                // Capturar primera fila del resultado
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                return $row;
            }catch (PDOException $e) {
                // Aquí puedes clasificar el error dependiendo de la excepción
                // para presentarlo en la respuesta Json
                return -1;
            }
        }

        public static function getTablaAcadem($idAlumno){
            // Consulta de la tabla Alumnos
            $consulta = "SELECT abg_hasdegree,abg_degree,abg_spdegree,abg_average,abg_datedegree,ins_name,aod_option
                            FROM aspirant_academicbg
                            INNER JOIN aspirant_institution ON aspirant_academicbg.aspirant_institution_id= aspirant_institution.ins_id
                            INNER JOIN aspirant_opdegree ON aspirant_academicbg.aspirant_opdegree_id = aspirant_opdegree.aod_id
                            WHERE aspirant_academicbg.aspirant_id = (SELECT a_id FROM aspirant WHERE user_id = ?)";
            try {
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute(array($idAlumno));
                // Capturar primera fila del resultado
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                return $row;
            }catch (PDOException $e) {
                // Aquí puedes clasificar el error dependiendo de la excepción
                // para presentarlo en la respuesta Json
                return -1;
            }
        }

        public static function getByIdCorreo($correo){
            // Consulta de la tabla Alumnos
            $consulta = "SELECT * FROM arsuser WHERE u_email = ?";
            try {
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute(array($correo));
                // Capturar primera fila del resultado
                $row = $comando->fetch(PDO::FETCH_ASSOC);
                return $row;
            }catch (PDOException $e) {
                // Aquí puedes clasificar el error dependiendo de la excepción
                // para presentarlo en la respuesta Json
                return -1;
            }
        }

        public static function getDocuments($idAlumno){
            // Consulta de la tabla Alumnos
            $consulta = "SELECT doc_type_id,doc_bien,comentario FROM aspirant_document
                                 WHERE aspirant_id = ?"; 
            try {
                // Preparar sentencia
                $comando = Database::getInstance()->getDb()->prepare($consulta);
                // Ejecutar sentencia preparada
                $comando->execute(array($idAlumno));
                // Capturar primera fila del resultado
                if($comando->rowCount() > 0){
                    while($row = $comando->fetch(PDO::FETCH_ASSOC)){
                        $userData[] = $row;
                    }
                }else{
                    $userData[]=$comando->fetch(PDO::FETCH_ASSOC);
                }
                return $userData;
            }catch (PDOException $e) {
                // Aquí puedes clasificar el error dependiendo de la excepción
                // para presentarlo en la respuesta Json
                return -1;
            }
        }

        public static function getPrueba($user_id,
                                        $a_gender,
                                        $a_birthday,
                                        $a_phonecode,
                                        $a_phonenumber,
                                        $a_celcode,     
                                        $a_celnumber,
                                        $fktalla,
                                        $a_program,
                                        $seat_id,
                                        $speciality_id,
                                        $area_id,
                                        $a_status,      
                                        $docs_subidos,
                                        $rfc,
                                        $aspirant_id,
                                        $abg_hasdegree,
                                        $abg_degree,
                                        $abg_spdegree,
                                        $abg_average,
                                        $abg_datedegree,
                                        $abg_rescomplete,
                                        $aspirant_institution_id,
                                        $aspirant_opdegree_id,
                                        $addr_id,
                                        $aa_neighborhood,
                                        $aa_postcode,
                                        $aa_streetaddr,
                                        $town_id,
                                        $state_id,
                                        $country_id){
            $comando = "INSERT INTO aspirant (user_id,a_gender,a_birthday,a_phonecode,a_phonenumber,a_celcode,a_celnumber,fktalla,a_program,seat_id,speciality_id,area_id,a_status,docs_subidos,rfc)
                        SELECT ?,?,?,?,?,?,?,(SELECT idTalla FROM talla WHERE Descripcion = ? LIMIT 1),?,?,(SELECT s_id FROM speciality WHERE s_name = ?),(SELECT a_id FROM area WHERE a_name = ?),?,?,?";
            $comando2 = "INSERT INTO aspirant_academicbg (aspirant_id,abg_hasdegree,abg_degree,abg_spdegree,abg_average,abg_datedegree,abg_rescomplete,aspirant_institution_id,aspirant_opdegree_id)
                        SELECT (SELECT a_id FROM aspirant WHERE user_id = ?),?,?,?,?,?,?,(SELECT ins_id FROM aspirant_institution WHERE ins_name = ?),(SELECT aod_id FROM aspirant_opdegree WHERE aod_option = ? LIMIT 1)";
            $comando3 = "INSERT INTO aspirant_addr (aspirant_id,aa_neighborhood,aa_postcode,aa_streetaddr,town_id,state_id,country_id)
                        SELECT (SELECT a_id FROM aspirant WHERE user_id = ?),?,?,?,(SELECT t_id FROM asptown WHERE t_name = ? and state_id=(SELECT state_id FROM aspstate WHERE state_name = '$state_id')),(SELECT state_id FROM aspstate WHERE state_name = ?),(SELECT c_id FROM aspcountry WHERE c_name = ?)";
            $comando4 = "DELETE FROM aspirant WHERE user_id='$user_id'";
            
            // Preparar la sentencia
            $sentencia = Database::getInstance()->getDb()->prepare($comando);
            $sentencia->execute(array($user_id,$a_gender,$a_birthday,$a_phonecode,$a_phonenumber,$a_celcode,
                         $a_celnumber,$fktalla,$a_program,$seat_id,$speciality_id,$area_id,$a_status,$docs_subidos,$rfc));
            if($sentencia=true){
                $sentencia2=Database::getInstance()->getDb()->prepare($comando2);
                $sentencia2->execute(array($aspirant_id,$abg_hasdegree,$abg_degree,$abg_spdegree,$abg_average,$abg_datedegree,
                                             $abg_rescomplete,$aspirant_institution_id,$aspirant_opdegree_id));
                if($sentencia2=true){
                     $sentencia3 = Database::getInstance()->getDb()->prepare($comando3);
                     $sentencia3->execute(array($addr_id,$aa_neighborhood,$aa_postcode,$aa_streetaddr,$town_id,$state_id,
                                             $country_id));
                    if($sentencia3=true){
                        return true;
                    }else{
                        $sentencia4 = Database::getInstance()->getDb()->prepare($comando4);
                        $sentencia4->execute(array($user_id));
                        return false; 
                    }
                }else{
                    $sentencia4 = Database::getInstance()->getDb()->prepare($comando4);
                    $sentencia4->execute(array($user_id));
                    return false;
                }
            }else{
                $sentencia4 = Database::getInstance()->getDb()->prepare($comando4);
                $sentencia4->execute(array($user_id));
                return false;
            }
        }
    }

?>
