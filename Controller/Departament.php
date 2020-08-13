<?php 
    require('../DAO/Departament.php');
    require('../Model/Departament.php');
    require('../Services/Authentication.php');

    if(!Authorization()){
        return;
    }

    $daoDepartament = new DAODepartament();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
        
    if ($method === 'GET') {
        $response = $daoDepartament->Select();

        if($response['error']){
            echo json_encode($response);
            return;
        }
        
        $departamentList = array("Error"=>$response['error'],"data"=>array());

        for ($i = 0; $i < count($response["data"]); $i++) {
            $departament = new Departament(
                $response["data"][$i]->id,
                $response["data"][$i]->description
            );
            array_push($departamentList["data"], $departament);
        }

        echo json_encode($departamentList);
        return;
    }

    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        $id = null;
        $description = $jsonBody['description'];
        
        $departament = new Departament($id,$description);

        echo json_encode($daoDepartament->Insert($departament));  

        return;
    }

    if ($method === 'PUT') {
        $jsonBody = json_decode($body, true);

        $id = (int)$jsonBody['id'];
        $description = $jsonBody['description'];

        $departament = new Departament($id,$description);

        echo json_encode($daoDepartament->Update($departament));  
        
        return;
    }

    if ($method === 'DELETE') {
   
         $jsonBody = json_decode($body, true);
         $id = $jsonBody['id'];
 
         echo json_encode($daoDepartament->Delete($id));  
        
        return;
    }
?>
