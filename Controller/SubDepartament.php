<?php 
    require('../DAO/SubDepartament.php');
    require('../Model/SubDepartament.php');
    require('../../Services/Authentication.php');

    if(!Authorization()){
        return;
    }

    $daoSubDepartament = new DAOSubDepartament();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');

    if ($method === 'GET') {
        $response = $daoSubDepartament->Select();

        if($response['error']){
            echo json_encode($response);
            return;
        }
        
        $subDepartamentList = array("Error"=>$response['error'],"data"=>array());

        for ($i = 0; $i < count($response["data"]); $i++) {
            $subDepartament = new SubDepartament(
                $response["data"][$i]->id,
                $response["data"][$i]->description,
                $response["data"][$i]->departament_id
            );
            array_push($subDepartamentList["data"], $subDepartament);
        }

        echo json_encode($subDepartamentList);
        return;
    }
    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        $description = $jsonBody['description'];
        $departament_id = $jsonBody['departament_id'];

        $subDepartament = new SubDepartament(null,$description,$departament_id);

        echo json_encode($daoSubDepartament->Insert($subDepartament));  

        return;
    }

    if ($method === 'PUT') {
        $jsonBody = json_decode($body, true);

        $id = $jsonBody['id'];
        $description = $jsonBody['description'];
        $departament_id = $jsonBody['departament_id'];

        $subDepartament = new SubDepartament($id,$description,$departament_id);

        echo json_encode($daoSubDepartament->Update($subDepartament));  
        
        return;
    }

    if ($method === 'DELETE') {
   
         $jsonBody = json_decode($body, true);
         $id = $jsonBody['id'];
 
         echo json_encode($daoSubDepartament->Delete($id));  
        
        return;
    }
?>
