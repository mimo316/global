<?php
require('../../Services/Connection.php');

class DAOTaskItem{  

    function Select($task_id): array {
        try {
            $connection = new Connection();
            $response = $connection->Select("SELECT * FROM `global`.`gt_task_item` WHERE `task_id` = ?",
            [
                $task_id
            ]
        );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Insert(TaskItem $taskItem) {
        try {
            $connection = new Connection();

            $response = $connection->Insert(
                "INSERT INTO `global`.`gt_task_item` (`description`, `task_id`) 
                VALUES (?, ?)", 
                [
                    $taskItem->getDescription(), 
                    $taskItem->getTaskId()
                ]
            );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Update(TaskItem $taskItem){
        try {
            $connection = new Connection();
            $response = $connection->Update(
                "UPDATE `global`.`gt_task_item` 
                SET 
                `description` = ?, 
                `check` = ?
                WHERE (`id` = ?);
                ", 
                [
                    $taskItem->getDescription(),
                    $taskItem->getCheck(),
                    $taskItem->getId()
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
            $response = $connection->Delete("DELETE FROM `global`.`gt_task_item` WHERE `id`=?", [$id]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }
}