<?php 
    require_once('../DAO/User.php');
    header('Content-type: application/json');

    $body = file_get_contents('php://input');

    if (!array_key_exists('login', $_GET)) {
        echo 'Error, Path missing.';
        return;
    }
    
    $path = explode('/', $_GET['login']);

    $daoUser = new DAOUser();
    $method = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');

    if ($method === 'POST') {
        $jsonBody = json_decode($body, true);

        if((!isset($jsonBody['user']) || $jsonBody['user'] == NULL)
            || (!isset($jsonBody['password']) || $jsonBody['password'] == NULL)){
            echo json_encode(array("error" => true, "message" => "(user, password) is broken"));
            return;
        }

        $user = $jsonBody['user'];
        $password = $jsonBody['password'];

        $response = $daoUser->SelectUser($user,$password);

        if($response['error']){
            echo json_encode($response);
            return;
        }

        if($response["data"][0]->status == 0){
            $response = array("error"=>true,"data"=>"This user is blocked");
            echo json_encode($response);
            return;
        };

        if($response["data"][0]->user == $user && $response["data"][0]->password == $password){

            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();

                $idSession = session_id();

                //var_dump($response)or die;
                $daoUser->UpdateSession($response["data"][0]->id,$idSession);

                $response = array("error"=>$response['error'],"data"=>$idSession);
            }

            echo json_encode($response);
        }else{
            $response = array("error"=>true,"data"=>"User or password error");
            echo json_encode($response);
            return;
        }
    }

?>
