<?php 
    require_once('../Services/Connection.php');
    
    class DAOShop {

        function Select(): array {
            try {
                $connection = new Connection();
                $response = $connection->Select("SELECT * FROM global._shop");
                return $response;
            } catch (Exception $e) {
                return $e;
            }
        }
    
        function Insert(Shop $shop)
        {
            try {
                $connection = new Connection();
                $response = $connection->Insert("INSERT INTO `global`.`_shop` (`id`, `description`, `cnpj`, `company_id`) VALUES (?,?,?,?)",
                [
                    $shop->getId(), 
                    $shop->getDescription(),
                    $shop->getCnpj(), 
                    $shop->getCompanyId()
                ]);
                return $response;
            } catch (Exception $e) {
                return $e;
            }
        }
    
        function Update(Shop $shop) {
            try {
                $connection = new Connection();
                $response = $connection->Update(
                    "UPDATE `global`.`_shop` SET `description`= ?, `cnpj`= ?, `company_id`= ? WHERE `id`= ?",
                    [
                        $shop->getdescription(),
                        $shop->getCNPJ(),
                        $shop->getCompanyId(),
                        $shop->getId()
                    ]);
                return $response;
            } catch (Exception $e) {
                return $e;
            }
        }
    
        function Delete($id) {
            try {
                $connection = new Connection();
                $response = $connection->Delete("DELETE FROM `global`.`_shop` WHERE `id`= ?", [$id]);
                return $response;
            } catch (Exception $e) {
                return $e;
            }
        }

       
    }
?>