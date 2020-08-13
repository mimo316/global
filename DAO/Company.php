<?php
require_once(dirname(__DIR__).'/Services/Connection.php');

class DAOCompany
{
    function Select() {
        try {
            $connection = new Connection();
            $response = $connection->Select("SELECT * FROM `global`.`_company`");
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Insert(company $company)
    {
        try {
            $connection = new Connection();
            $response = $connection->Insert("INSERT INTO `global`.`_company` VALUES (?,?)", 
            [
                $company->getId(), 
                $company->getDescription()
            ]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Update(Company $company)
    {
        try {
            $connection = new Connection();
            $response = $connection->Update("UPDATE `global`.`_company` SET `description`= ? WHERE `id`=?", [$company->getDescription(),$company->getId()]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Delete($id) {
        try {
            $connection = new Connection();
            $response = $connection->Delete("DELETE FROM `global`.`_company` WHERE `id`=?", [$id]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }
}
