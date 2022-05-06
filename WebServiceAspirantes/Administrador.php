<?php

    require 'Database.php';

    class Administrador{
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
            $consulta = "SELECT u_id,u_name,u_midname,u_lastname,u_foreign,u_passwd,u_email,user_type FROM arsuser WHERE u_email = ? and u_passwd= ? and user_type=1";
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
    }

?>
