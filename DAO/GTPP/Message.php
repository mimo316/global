<?php
require_once('../../Services/Connection.php');

class DAOMessage{   

    function Select($task_id): array {
        try {
            $connection = new Connection();
            $response = $connection->Select("SELECT * FROM `global`.`gt_message` WHERE `task_id` = ?",
            [
                $task_id
            ]
        );
            return $response;
        } catch (Exception $e) {
            echo $e;
            return NULL;
        }
    }

    function Insert(Message $task)
    {
        try {
            $connection = new Connection();

            $response = $connection->Insert(
                "INSERT INTO `global`.`gt_message` (`description`, `date_time`, `task_id`, `user_id`) 
                VALUES (?, NOW(), ?, ?)", 
                [
                    $task->getDescription(), 
                    $task->getTaskId(), 
                    $task->getUserId()
                ]
            );
            return $response;
        } catch (Exception $e) {
            echo $e;
            return NULL;
        }
    }

    function Delete($id) {
        try {
            $connection = new Connection();
            $response = $connection->Delete("DELETE FROM `global`.`gt_message` WHERE `id`= ?", [$id]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }
}