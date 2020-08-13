<?php 
    require('../../DAO/GTPP/Message.php');
    require('../../Model/GTPP/Message.php');
    require('../../Services/Authentication.php');

    if(!Authorization()){
        return;
    }

    $daoMessage = new DAOMessage();
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

        $response = $daoMessage->Select($task_id);

        if($response['error']){
            echo json_encode($response);
            return;
        }
        
        $messageList = array("Error"=>$response['error'],"data"=>array());

        for ($i = 0; $i < count($response["data"]); $i++) {
            $message = new Message(
                $response["data"][$i]->id,
                $response["data"][$i]->description,
                $response["data"][$i]->date_time,
                $response["data"][$i]->task_id,
                $response["data"][$i]->user_id
            );
            array_push($messageList["data"], $message);
        }

        echo json_encode($messageList);
        return;
    }
    
    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        $description = $jsonBody['description'];
        $task_id = $jsonBody['task_id'];
        $user_id = $jsonBody['user_id'];  

        if((!isset($jsonBody['description']) || $jsonBody['description'] == NULL)
            || (!isset($jsonBody['task_id']) || $jsonBody['task_id'] == NULL)
            || (!isset($jsonBody['user_id']) || $jsonBody['user_id'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(description, task_id, user_id) is broken"));
            http_response_code(400);
            return;
        }

        echo json_encode($daoMessage->Insert(
            new Message(
                null,
                $description,
                null,
                $task_id,
                $user_id
            )
        ));  

        return;
    }

    if ($method === 'DELETE') {
        $jsonBody = json_decode($body, true);
        $id = $jsonBody['id'];

        if(!isset($jsonBody['id']) || $jsonBody['id'] == NULL){
            echo json_encode(array("error" => true, "message" => "(id) is broken"));
            http_response_code(400);
            return;
        }

         echo json_encode($daoMessage->Delete($id));  
        
        return;
    }
?>
