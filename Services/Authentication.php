<?php 

    function Authorization(){
        require_once(dirname(__DIR__).'/DAO/User.php');

        header('Content-type: application/json');

        if (!isset($_GET['AUTH'])){
            echo json_encode(array("error" => true, "message" => "Authorization is missing"));
            http_response_code(401);
            return false;
        }

        $authorization = $_GET['AUTH'];

        $daoUser = new DAOUser();

        $session = $daoUser->SelectSession($authorization);

        if($session["error"]){
            echo json_encode(array("error" => true, "message" => " Authorization denied"));
            http_response_code(401);
            return false;
        }

        return true;
    }
?>