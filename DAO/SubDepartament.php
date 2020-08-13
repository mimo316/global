<?php
require_once('../Services/Connection.php');

class DAOSubDepartament{
    
    function Select(): array {
        try {
            $connection = new Connection();
            $response = $connection->Select("SELECT * FROM `global`.`_sub_departament`");
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Insert(subDepartament $subDepartament)
    {
        try {
            $connection = new Connection();
            $response = $connection->Insert("INSERT INTO `global`.`_sub_departament` (`description`, `departament_id`) VALUES (?,?)", 
            [
                $subDepartament->getDescription(),
                $subDepartament->getDepartament_id()
            ]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Update(subDepartament $subDepartament){
        try {
            $connection = new Connection();
            $response = $connection->Update("UPDATE `global`.`_sub_departament` SET `description`=?, `departament_id`=? WHERE `id`=?", 
            [
                $subDepartament->getDescription(),
                $subDepartament->getDepartament_id(),
                $subDepartament->getId()
            ]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Delete($id) {
        try {
            $connection = new Connection();
            $response = $connection->Delete("DELETE FROM `global`.`_sub_departament` WHERE `id`=?", [$id]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }
}
