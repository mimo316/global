<?php 
    require('../../DAO/GTPP/Task_User.php');
    require('../../Model/GTPP/Task_User.php');
    require('../../Services/Authentication.php');

    if(!Authorization()){
        return;
    }

    $daoTask_User = new DAOTask_User();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');

    if ($method === 'GET') {
        $jsonBody = json_decode($body, true);
        
        if(!isset($jsonBody['task_id']) || $jsonBody['task_id'] == NULL){
            echo json_encode(array("error" => true, "message" => "(task_id) is broken"));
            http_response_code(400);
            return;
        }

        $task_id = $jsonBody['task_id'];

        $values = $daoTask_User->Select($task_id);
       
        echo json_encode($values);
        return;
    }

    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        if((!isset($jsonBody['task_id']) || $jsonBody['task_id'] == NULL)
            || (!isset($jsonBody['user_id']) || $jsonBody['user_id'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(task_id, user_id) is broken"));
            http_response_code(400);
            return;
        }

        echo json_encode($daoTask_User->Insert(
            new Task_User(
                $jsonBody['task_id'],
                $jsonBody['user_id']
            )
        ));  
        return;
    }

    if ($method === 'DELETE') {
        $jsonBody = json_decode($body, true);
 
        if((!isset($jsonBody['task_id']) || $jsonBody['task_id'] == NULL)
            || (!isset($jsonBody['user_id']) || $jsonBody['user_id'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(task_id, user_id) is broken"));
            http_response_code(400);
            return;
        }

        echo json_encode($daoTask_User->Delete(
            new Task_User(
                $jsonBody['task_id'],
                $jsonBody['user_id']
            )
        ));  
        return;
    }
?>
