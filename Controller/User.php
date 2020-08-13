<?php 
    require('../DAO/User.php');
    require('../Model/User.php');
    require('../Services/Authentication.php');

    if(!Authorization()){
        return;
    }
    
    $daoUser = new DAOUser();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
    
    if ($method === 'GET') {
        $response = $daoUser->Select();

        if($response['error']){
            echo json_encode($response);
            return;
        }
        
        $userList = array("Error"=>$response['error'],"data"=>array());

        for ($i = 0; $i < count($response["data"]); $i++) {
            $user = new User(
                $response["data"][$i]->id,
                $response["data"][$i]->user,
                null,
                $response["data"][$i]->status
            );
            array_push($userList["data"], $user);
        }

        echo json_encode($userList);
        return;
    }
    
    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        $id = $jsonBody['id'];
        $user = $jsonBody['user'];
        $password = $jsonBody['password'];

        echo json_encode($daoUser->Insert(new User($id,$user,$password,null)));  

        return;
    }

    if ($method === 'PUT') {
        $jsonBody = json_decode($body, true);

        $id = $jsonBody['id'];
        $user = $jsonBody['user'];
        $password = $jsonBody['password'];
        $status = $jsonBody['status'];

        echo json_encode($daoUser->Update(new User($id,$user,$password,$status)));  
        
        return;
    }

    if ($method === 'DELETE') {
   
         $jsonBody = json_decode($body, true);
         $id = $jsonBody['id'];
 
         echo json_encode($daoUser->Delete($id));  
        
        return;
    }
?>
