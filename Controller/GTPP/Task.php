<?php 
    require('../../Model/GTPP/Task.php');
    require('../../DAO/GTPP/Task.php');
    require('../../Services/Authentication.php');

    if(!Authorization()){
        return;
    }

    $daoTask = new DAOTask();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
   
    if ($method === 'GET') {
        $jsonBody = json_decode($body, true);

        if((!isset($jsonBody['user_id']) || $jsonBody['user_id'] == NULL)
            ||(!isset($jsonBody['state']) || $jsonBody['state'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(user_id, state) is broken"));
            http_response_code(400);
            return;
        }

        $user_id = $jsonBody['user_id'];
        $state = $jsonBody['state'];

        $response = $daoTask->Select($user_id,$state);
        
        if($response['error']){
            echo json_encode($response);
            return;
        }
        
        $taskList = array("Error"=>$response['error'],"data"=>array());

        for ($i = 0; $i < count($response["data"]); $i++) {
            $task = new Task(
                $response["data"][$i]->id,
                $response["data"][$i]->description,
                $response["data"][$i]->full_description,
                $response["data"][$i]->initial_date,
                $response["data"][$i]->final_date,
                $response["data"][$i]->state,
                $response["data"][$i]->priority,
                $response["data"][$i]->user_id,
                $response["data"][$i]->shop_id,
                $response["data"][$i]->dept_id,
                $response["data"][$i]->sub_dept_id
            );
            array_push($taskList["data"], $task);
        }

        echo json_encode($taskList);
        return;
    }
    
    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        if((!isset($jsonBody['description']) || $jsonBody['description'] == NULL)
            || (!isset($jsonBody['full_description']) || $jsonBody['full_description'] == NULL)
            || (!isset($jsonBody['initial_date']) || $jsonBody['initial_date'] == NULL)
            || (!isset($jsonBody['final_date']) || $jsonBody['final_date'] == NULL)
            || (!isset($jsonBody['priority']) || $jsonBody['priority'] == NULL)
            || (!isset($jsonBody['user_id']) || $jsonBody['user_id'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(description, full_description, initial_date, final_date, priority, user_id) is broken"));
            http_response_code(400);
            return;
        }

        $description = $jsonBody['description'];
        $full_description = $jsonBody['full_description'];
        $initial_date = $jsonBody['initial_date'];
        $final_date = $jsonBody['final_date'];
        $priority = $jsonBody['priority'];
        $user_id = $jsonBody['user_id'];

        $task = new Task(
            null,
            $description,
            $full_description,
            $initial_date,
            $final_date,
            null,
            $priority,
            $user_id,
            null,
            null,
            null
        );

        echo json_encode($daoTask->Insert($task));  
    }

    if ($method === 'PUT') {
        $jsonBody = json_decode($body, true);

        
        if((!isset($jsonBody['id']) || $jsonBody['id'] == NULL)
            || (!isset($jsonBody['description']) || $jsonBody['description'] == NULL)
            || (!isset($jsonBody['full_description']) || $jsonBody['full_description'] == NULL)
            || (!isset($jsonBody['initial_date']) || $jsonBody['initial_date'] == NULL)
            || (!isset($jsonBody['final_date']) || $jsonBody['final_date'] == NULL)
            || (!isset($jsonBody['state']) || $jsonBody['state'] == NULL)
            || (!isset($jsonBody['priority']) || $jsonBody['priority'] == NULL)
            || (!isset($jsonBody['user_id']) || $jsonBody['user_id'] == NULL)
            || (!isset($jsonBody['shop_id']) || $jsonBody['shop_id'] == NULL)
            || (!isset($jsonBody['dept_id']) || $jsonBody['dept_id'] == NULL)
            || (!isset($jsonBody['sub_dept_id']) || $jsonBody['sub_dept_id'] == NULL)){
            echo json_encode(array("error" => true, 
            "message" => "(id, description, full_description, initial_date, final_date, state, priority, user_id, shop_id, dept_id, sub_dept_id) is broken"));
            http_response_code(400);
            return;
        }

        $id = $jsonBody['id'];
        $description = $jsonBody['description'];
        $full_description = $jsonBody['full_description'];
        $initial_date = $jsonBody['initial_date'];
        $final_date = $jsonBody['final_date'];
        $state = $jsonBody['state'];
        $priority = $jsonBody['priority'];
        $user_id = $jsonBody['user_id'];
        $shop_id = $jsonBody['shop_id'];
        $dept_id = $jsonBody['dept_id'];
        $sub_dept_id = $jsonBody['sub_dept_id'];

        $task = new Task(
            $id,
            $description,
            $full_description,
            $initial_date,
            $final_date,
            $state,
            $priority,
            $user_id,
            $shop_id,
            $dept_id,
            $sub_dept_id
        );

        echo json_encode($daoTask->Update($task));  
    }

    if ($method === 'DELETE') {
        $jsonBody = json_decode($body, true);

        if((!isset($jsonBody['id']))){
            echo json_encode(array("error" => true, "message" => "(id) is broken"));
            http_response_code(400);
            return;
        }

        $id = $jsonBody['id'];

        echo json_encode($daoTask->Delete($id));  
    }
?>