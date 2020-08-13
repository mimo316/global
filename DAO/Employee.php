<?php
require_once('../Services/Connection.php');

class DAOEmployee
{
    function Select(): array {
        try {
            $connection = new Connection();
            $response = $connection->Select("SELECT * FROM `global`.`_employee`");
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Insert(Employee $employee)
    {
        try {
            $connection = new Connection();
            $response = $connection->Insert(
                "INSERT INTO `global`.`_employee`  (`name`, `shop_id`, `sub_id`) VALUES (?,?,?)", 
                [ 
                    $employee->getName(), 
                    $employee->getShopId(), 
                    $employee->getSubId()
                ]
            );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Update(Employee $employee)
    {
        try {
            $connection = new Connection();
            $response = $connection->Update(
                "UPDATE `global`.`_employee` 
                SET `name` = ?, `shop_id` = ?, `sub_id` = ?
                WHERE (`id` = ?)",
                [
                    $employee->getName(),
                    $employee->getShopId(),
                    $employee->getSubId(),
                    $employee->getId()
                ]
            );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Delete($id) {
        try {
            $connection = new Connection();
            $response = $connection->Delete("DELETE FROM `global`.`_employee` WHERE `id`=?", [$id]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }
}