<?php
require_once('../Services/Connection.php');

class DAODepartament{
    
    function Select(): array {
        try {
            $connection = new Connection();
            $response = $connection->Select("SELECT * FROM `global`.`_departament`");
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Insert(Departament $departament)
    {
        try {
            $connection = new Connection();
            $response = $connection->Insert("INSERT INTO `global`.`_departament` (`description`) VALUES (?)", 
            [
                $departament->getDescription()
            ]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Update(Departament $departament) {
       
        try {
            $connection = new Connection();
            $response = $connection->Update("UPDATE `global`.`_departament` SET `description`= ? WHERE `id`= ?", 
            [
                $departament->getDescription(),
                $departament->getId()
            ]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Delete($id) {
        try {
            $connection = new Connection();
            $response = $connection->Delete("DELETE FROM `global`.`_departament` WHERE `id`=?", [$id]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }
}
