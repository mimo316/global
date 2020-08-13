<?php
require_once(dirname(__DIR__).'/Services/Connection.php');

class DAOUser{

    function Select(): array {
        try {
            $connection = new Connection();
            $response = $connection->Select("SELECT `id`, `user`, `status` FROM `global`.`_user`");
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Insert(User $user) {
        try {
            $connection = new Connection();
            $response = $connection->Insert(
                "INSERT INTO `global`.`_user` (`id`, `user`, `password`) VALUES (?,?,?)", 
                [
                    $user->getId(), 
                    $user->getUser(), 
                    $user->getPassword()
                ]
            );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Update(User $user) {
        try {
            $connection = new Connection();
            $response = $connection->Update(
                "UPDATE `global`.`_user` 
                SET `user` = ?, `password` = ?, `status` = ?
                WHERE (`id` = ?)",
                [
                    $user->getUser(),
                    $user->getPassword(),
                    $user->getStatus(),
                    $user->getId()
                ]
            );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Delete($id) {
        try {
            $connection = new Connection();
            $response = $connection->Delete("DELETE FROM `global`.`_user` WHERE `id`=?", [$id]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function SelectUser($user, $password) {
        try {
            $connection = new Connection();
            $response = $connection->Select(
                "SELECT id, user, password, status FROM `global`.`_user` WHERE user = ? AND password = ?",
                [
                    $user, 
                    $password
                ]
            );

            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function UpdateSession($id, $session) {
        try {
            $connection = new Connection();
            $response = $this->SelectSession($session);

            if ($response["error"]){
                if($response["message"] == "No data"){
                    $response = $this->UpdateInnerSession($id, $session);
                }else{
                    if(count($response)> 0){
                        for ($i=0; $i < count($response["data"]); $i++) { 
                            $connection->Update(
                                "UPDATE `global`.`_user` 
                                SET `session` = ?
                                WHERE (`id` = ?)",
                                [
                                    NULL,
                                    $response["data"][$i]->id
                                ]
                            );
                        }
                    }
                    $response = $this->UpdateInnerSession($id, $session);
                }
            }
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function SelectSession($session) {
        try {
            $connection = new Connection();
            $response = $connection->Select(
                "SELECT id FROM `global`.`_user` WHERE session = ?",
                [
                    $session
                ]
            );

            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    private function UpdateInnerSession($id, $session){
        $connection = new Connection();
        $response = $connection->Update(
            "UPDATE `global`.`_user` 
            SET `session` = ?
            WHERE (`id` = ?)",
            [
                $session,
                $id
            ]
        );
        return $response;
    }
}