<?php 
    require('../DAO/Company.php');
    require('../Model/Company.php');
    require('../Services/Authentication.php');

    if(!Authorization()){
        return;
    }

    $daoCompany = new DAOCompany();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
    
    if ($method === 'GET') {
        $response = $daoCompany->Select();

        if($response['error']){
            echo json_encode($response);
            return;
        }
        
        $companyList = array("Error"=>$response['error'],"data"=>array());

        for ($i = 0; $i < count($response["data"]); $i++) {
            $company = new Company(
                $response["data"][$i]->id,
                $response["data"][$i]->description
            );
            array_push($companyList["data"], $company);
        }

        echo json_encode($companyList);
        return;
    }
    
    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        if((!isset($jsonBody['id']) || $jsonBody['id'] == NULL)
            || (!isset($jsonBody['description']) || $jsonBody['description'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(id, description) is broken"));
            return;
        }

        $id = $jsonBody['id'];
        $description = $jsonBody['description'];

        $company = new Company($id,$description);

       echo json_encode($daoCompany->Insert($company));  

        return;
    }

    if ($method === 'PUT') {
        $jsonBody = json_decode($body, true);
        
        if((!isset($jsonBody['id']) || $jsonBody['id'] == NULL)
            || (!isset($jsonBody['description']) || $jsonBody['description'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(id, description) is broken"));
            return;
        }

        $id = $jsonBody['id'];
        $description = $jsonBody['description'];

        $company = new Company($id, $description);
        
        echo json_encode($daoCompany->Update($company));  
        
        return;
    }

    if ($method === 'DELETE') {
         $jsonBody = json_decode($body, true);
         
        if((!isset($jsonBody['id']) || $jsonBody['id'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(id, description) is broken"));
            return;
        }
    
         $id = $jsonBody['id'];

         echo json_encode($daoCompany->Delete($id));  
        
        return;
    }
?>
