<?php 
    require('../Model/Shop.php');
    require('../DAO/Shop.php');
    require('../Services/Authentication.php');

    if(!Authorization()){
        return;
    }

    $daoShop = new DAOShop();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');

    if ($method === 'GET') {
        $response = $daoShop->Select();

        if($response['error']){
            echo json_encode($response);
            return;
        }
        
        $shopList = array("Error"=>$response['error'],"data"=>array());

        for ($i = 0; $i < count($response["data"]); $i++) {
            $shop = new Shop(
                $response["data"][$i]->id,
                $response["data"][$i]->description,
                $response["data"][$i]->cnpj,
                $response["data"][$i]->company_id
            );
            array_push($shopList["data"], $shop);
        }

        echo json_encode($shopList);
        return;
    }

    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);
        
        if((!isset($jsonBody['id']) || $jsonBody['id'] == NULL)
            || (!isset($jsonBody['company_id']) || $jsonBody['company_id'] == NULL)
            || (!isset($jsonBody['description']) || $jsonBody['description'] == NULL)
            || (!isset($jsonBody['cnpj']) || $jsonBody['cnpj'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(id, company_id, description, cnpj) is broken"));
            return;
        }

        $id= $jsonBody['id'];
        $company_id= $jsonBody['company_id'];
        $description =$jsonBody['description'];
        $cnpj = $jsonBody['cnpj'];
    
        $shop = new Shop($id, $description,$cnpj,$company_id);
        
        echo json_encode($daoShop->Insert($shop));  
        
        return;
    }

    if ($method === 'PUT') {
        $jsonBody = json_decode($body, true);

        if((!isset($jsonBody['id']) || $jsonBody['id'] == NULL)
        || (!isset($jsonBody['company_id']) || $jsonBody['company_id'] == NULL)
        || (!isset($jsonBody['description']) || $jsonBody['description'] == NULL)
        || (!isset($jsonBody['cnpj']) || $jsonBody['cnpj'] == NULL)){
        echo json_encode(array("error" => true, "message" => "(id, company_id, description, cnpj) is broken"));
        return;
    }
        $id = $jsonBody['id'];
        $description = $jsonBody['description'];
        $company_id = $jsonBody['company_id'];
        $cnpj = $jsonBody['cnpj'];

        $shop = new Shop($id,$description,$cnpj,$company_id);

        echo json_encode($daoShop->Update($shop));  
        
        return;
    }

    if ($method === 'DELETE') {
        $jsonBody = json_decode($body, true);

        if((!isset($jsonBody['id']) || $jsonBody['id'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(id, company_id, description, cnpj) is broken"));
            return;
        }

        $id = $jsonBody['id'];
        echo json_encode($daoShop->Delete($id));  
        
        return;
    }
?>