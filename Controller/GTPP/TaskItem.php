<?php 
    require('../../DAO/GTPP/TaskItem.php');
    require('../../Model/GTPP/TaskItem.php');
    require('../../Services/Authentication.php');

    if(!Authorization()){
        return;
    }

    $daoTaskItem = new DAOTaskItem();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');

    if ($method === 'GET') {
        $jsonBody = json_decode($body, true);
        $task_id = $jsonBody['task_id'];

        if(!isset($jsonBody['task_id']) || $jsonBody['task_id'] == NULL){
            echo json_encode(array("error" => true, "message" => "(task_id) is broken"));
            http_response_code(400);
            return;
        }

        $values = $daoTaskItem->Select($task_id);
       
        echo json_encode($values);
        return;
    }
    
    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        if((!isset($jsonBody['description']) || $jsonBody['description'] == NULL)
            || (!isset($jsonBody['task_id']) || $jsonBody['task_id'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(description, task_id) is broken"));
            http_response_code(400);
            return;
        }

        $description = $jsonBody['description'];
        $task_id = $jsonBody['task_id'];

        echo json_encode($daoTaskItem->Insert(
            new TaskItem(
                null,
                $description,
                null,
                $task_id
            )
        ));  

        return;
    }

    if ($method === 'PUT') {
        $jsonBody = json_decode($body, true);

        if((!isset($jsonBody['id']) || $jsonBody['id'] == NULL)
            || (!isset($jsonBody['description']) || $jsonBody['description'] == NULL)
            || (!isset($jsonBody['check']) || $jsonBody['check'] == NULL)
            || (!isset($jsonBody['task_id']) || $jsonBody['task_id'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(id, description, check, task_id) is broken"));
            http_response_code(400);
            return;
        }

        $id = $jsonBody['id'];
        $description = $jsonBody['description'];
        $check = $jsonBody['check'];
        $task_id = $jsonBody['task_id'];
        
        $taskItem = new TaskItem(
            $id,
            $description,
            $check,
            $task_id
        );

        echo json_encode($daoTaskItem->Update($taskItem));  
    }

    if ($method === 'DELETE') {
         $jsonBody = json_decode($body, true);

         if(!isset($jsonBody['id']) || $jsonBody['id'] == NULL){
            echo json_encode(array("error" => true, "message" => "(id) is broken"));
            http_response_code(400);
            return;
        }

         $id = $jsonBody['id'];

         echo json_encode($daoTaskItem->Delete($id));  
        
        return;
    }
?>
