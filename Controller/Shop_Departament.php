<?php 
    require('../DAO/Shop_Departament.php');
    require('../Model/Shop_Departament.php');
    require('../Services/Authentication.php');

    if(!Authorization()){
        return;
    }

    $daoShop_Departament = new DAOShop_Departament();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
    
    if ($method === 'GET') {
        $response = $daoShop_Departament->Select();

        if($response['error']){
            echo json_encode($response);
            return;
        }
        
        $shop_DepartamentList = array("Error"=>$response['error'],"data"=>array());

        for ($i = 0; $i < count($response["data"]); $i++) {
            $shop_Departament = new Shop_Departament(
                $response["data"][$i]->shop_id,
                $response["data"][$i]->departament_id
            );
            array_push($shop_DepartamentList["data"], $shop_Departament);
        }

        echo json_encode($shop_DepartamentList);
        return;
    }
    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        $shop_id = $jsonBody['shop_id'];
        $departament_id = $jsonBody['departament_id'];

        $shop_departament = new Shop_Departament($shop_id, $departament_id);

        echo json_encode($daoShop_Departament->Insert($shop_departament));  

        return;
    }

    if ($method === 'PUT') {
        $jsonBody = json_decode($body, true);

        $shop_id = $jsonBody[0]['shop_id'];
        $departament_id = $jsonBody[0]['departament_id'];

        $shop_id_old = $jsonBody[1]['shop_id'];
        $departament_id_old = $jsonBody[1]['departament_id'];

        $shop_departament = new Shop_Departament($shop_id, $departament_id);

        $shop_departament_old = new Shop_Departament($shop_id_old, $departament_id_old);

        echo json_encode($daoShop_Departament->Update($shop_departament, $shop_departament_old));  
        
        return;
    }

    if ($method === 'DELETE') {
   
         $jsonBody = json_decode($body, true);

         $shop_id = $jsonBody['shop_id'];
         $departament_id = $jsonBody['departament_id'];

         $shop_departament = new Shop_Departament($shop_id, $departament_id);
 
         echo json_encode($daoShop_Departament->Delete($shop_departament));  
        
        return;
    }
?>
