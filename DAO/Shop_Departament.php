<?php 
    require_once('../Services/Connection.php');
    
    class DAOShop_Departament {

        function Select(): array {
            try {
                $connection = new Connection();
                $response = $connection->Select("SELECT * FROM global._shop_departament");
                return $response;
            } catch (Exception $e) {
                return $e;
            }
        }
    
        function Insert(Shop_Departament $shop_departament)
        {
            try {
                $connection = new Connection();
                $response = $connection->Insert("INSERT INTO `global`.`_shop_departament` (`shop_id`, `departament_id`) VALUES (?,?)",
                [
                    $shop_departament->getShopId(), 
                    $shop_departament->getDepartamentId()
                ]);
                return $response;
            } catch (Exception $e) {
                return $e;
            }
        }
    
        function Update(Shop_Departament $shop_departament, Shop_Departament $shop_departament_old) {
            try {
                $connection = new Connection();
                $response = $connection->Update(
                    "UPDATE `global`.`_shop_departament` 
                    SET `departament_id`=? 
                    WHERE (`shop_id` = ?) and (`departament_id` = ?);",
                [
                    $shop_departament->getDepartamentId(),

                    $shop_departament_old->getShopId(), 
                    $shop_departament_old->getDepartamentId()
                ]);

                return $response;
            } catch (Exception $e) {
                return $e;
            }
        }
    
        function Delete(Shop_Departament $shop_departament) {
            try {
                $connection = new Connection();
                $response = $connection->Delete("DELETE FROM `global`.`_shop_departament` WHERE (`shop_id` = ? ) AND (`departament_id` = ?)",
                [
                    $shop_departament->getShopId(),
                    $shop_departament->getDepartamentId()
                ]);
                return $response;
            } catch (Exception $e) {
                return $e;
            }
        }

       
    }
?>