<?php 
    require('../DAO/Employee.php');
    require('../Model/Employee.php');
    require('../Services/Authentication.php');

    if(!Authorization()){
        return;
    }

    $daoEmployee = new DAOEmployee();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
    
    if ($method === 'GET') {
        $values = $daoEmployee->Select();
       
        echo json_encode($values);
        return;
    }
    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        $name = $jsonBody['name'];
        $sub_id = $jsonBody['sub_id'];
        $shop_id = $jsonBody['shop_id'];

        echo json_encode($daoEmployee->Insert(new Employee(null,$name,$sub_id,$shop_id)));  

        return;
    }

    if ($method === 'PUT') {
        $jsonBody = json_decode($body, true);

        $id = $jsonBody['id'];
        $name = $jsonBody['name'];
        $sub_id = $jsonBody['sub_id'];
        $shop_id = $jsonBody['shop_id'];

        echo json_encode($daoEmployee->Update(new Employee($id,$name,$sub_id,$shop_id)));  
        
        return;
    }

    if ($method === 'DELETE') {
   
         $jsonBody = json_decode($body, true);
         $id = $jsonBody['id'];
 
         echo json_encode($daoEmployee->Delete($id));  
        
        return;
    }
?>
