<?php
require('../../Services/Connection.php');

class DAOTask_User
{   

    function Select($task_id): array {
        try {
            $connection = new Connection();
            $response = $connection->Select(
                "SELECT * FROM `global`.`gt_task_user` 
                WHERE `task_id`= ?",
                [
                    $task_id
                ]
            );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Insert(Task_User $task_User) {
        try {
            $connection = new Connection();

            $response = $connection->Insert(
                "INSERT INTO `global`.`gt_task_user` (`user_id`, `task_id`) 
                VALUES (?, ?)", 
                [
                    $task_User->getUserId(), 
                    $task_User->getTaskId()
                ]
            );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Delete(Task_User $task_User) {
        try {
            $connection = new Connection();

            $response = $connection->Delete(
                "DELETE FROM `global`.`gt_task_user` WHERE (`user_id`=?) AND (`task_id`=?)", 
                [
                    $task_User->getUserId(), 
                    $task_User->getTaskId()
                ]
            );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }
}