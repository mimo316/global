<?php
require_once('../../Services/Connection.php');

class DAOTask{   

    function Select($user_id,$state): array {
        try {
            $connection = new Connection();
            $response = $connection->Select(
                "SELECT gt_task.id, description, full_description, initial_date, final_date, state, priority, gt_task.user_id, shop_id, dept_id, sub_dept_id 
                FROM global.gt_task_user
                LEFT JOIN global.gt_task
                ON gt_task.id = gt_task_user.task_id
                INNER JOIN global._user
                ON gt_task.user_id = _user.id
                WHERE (gt_task_user.user_id = ?
                OR gt_task.user_id = ?) AND state = ?
                UNION
                SELECT gt_task.id, description, full_description, initial_date, final_date, state, priority, gt_task.user_id, shop_id, dept_id, sub_dept_id 
                FROM global.gt_task_user
                RIGHT JOIN global.gt_task
                ON gt_task.id = gt_task_user.task_id
                INNER JOIN global._user
                ON gt_task.user_id = _user.id
                WHERE (gt_task_user.user_id = ?
                OR gt_task.user_id = ?) AND state = ?",
                [
                    $user_id,
                    $user_id,
                    $state,
                    $user_id,
                    $user_id,
                    $state
                ]
            );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Insert(Task $task){
        
        try {
            $connection = new Connection();

            $response = $connection->Insert(
                "INSERT INTO `global`.`gt_task` (`description`, `full_description`, `initial_date`, `final_date`, `priority`, `user_id`) 
                VALUES (?, ?, ?, ?, ?, ?)", 
                [
                    $task->getDescription(), 
                    $task->getFullDescription(), 
                    $task->getInitialDate(), 
                    $task->getFinalDate(), 
                    $task->getPriority(),
                    $task->getUserId()
                ]
            );
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function Update(Task $task){
        try {
            $connection = new Connection();
            $response = $connection->Update(
                "UPDATE `global`.`gt_task` 
                SET 
                `description` = ?, 
                `full_description` = ?, 
                `initial_date` = ?, 
                `final_date` = ?, 
                `state` = ?, 
                `priority` = ?, 
                `shop_id` = ?, 
                `dept_id` = ?, 
                `sub_dept_id` = ? 
                WHERE (`id` = ?);
                ", 
                [
                    $task->getDescription(),
                    $task->getFullDescription(),
                    $task->getInitialDate(),
                    $task->getFinalDate(),
                    $task->getState(),
                    $task->getPriority(),
                    $task->getShopId(),
                    $task->getDeptId(),
                    $task->getSubDeptId(),
                    $task->getId()
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
            $response = $connection->Delete("DELETE FROM `global`.`gt_task` WHERE `id`=?", [$id]);
            return $response;
        } catch (Exception $e) {
            return $e;
        }
    }

    function SelectByIDs($shop_id,$dept_id,$sub_dept_id,$priority): array {
        try {
            $connection = new Connection();
            $query = "SELECT * FROM `global`.`gt_task` WHERE ";

            if($shop_id != null){
                $query = $query."`shop_id`=".$shop_id;
            }

            if($dept_id != null && $shop_id != null){
                $query = $query." AND `dept_id`=".$dept_id;
            }

            if($sub_dept_id != null && $dept_id != null && $shop_id != null){
                $query = $query." AND `sub_dept_id`=".$sub_dept_id;
            }

            if($priority != null){
                if($shop_id != null){
                    $query = $query." AND `priority`=".$priority;
                }else{
                    $query = $query." `priority`=".$priority;
                }
            }

            $response = $connection->Select($query);
            $taskList = array();

            for ($i = 0; $i < count($response); $i++) {
                $task = new Task(
                    $response[$i]->id,
                    utf8ize($response[$i]->description),
                    utf8ize($response[$i]->full_description),
                    $response[$i]->initial_date,
                    $response[$i]->final_date,
                    $response[$i]->state,
                    $response[$i]->priority,
                    $response[$i]->user_id,
                    $response[$i]->shop_id,
                    $response[$i]->dept_id,
                    $response[$i]->sub_dept_id
                );
                array_push($taskList, $task);
            }
            
            return $taskList;
        } catch (Exception $e) {
            return $e;
        }
    }

    function SelectByPriority($priority): array {
        try {
            $connection = new Connection();
            $query = "SELECT * FROM `global`.`gt_task` WHERE `priority` = ".$priority;

            $response = $connection->Select($query);
            $taskList = array();

            for ($i = 0; $i < count($response); $i++) {
                $task = new Task(
                    $response[$i]->id,
                    utf8ize($response[$i]->description),
                    utf8ize($response[$i]->full_description),
                    $response[$i]->initial_date,
                    $response[$i]->final_date,
                    $response[$i]->state,
                    $response[$i]->priority,
                    $response[$i]->user_id,
                    $response[$i]->shop_id,
                    $response[$i]->dept_id,
                    $response[$i]->sub_dept_id
                );
                array_push($taskList, $task);
            }
            
            return $taskList;
        } catch (Exception $e) {
            return $e;
        }
    }

    // function FilterByPriority ($array, $index, $value): array{ 
    //     $filtered_array=null;
    //     if(is_array($array) && count($array)>0) 
    //     {
    //         foreach(array_keys($array) as $key){
    //             $temp[$key] = $array[$key][$index];

    //             if ($temp[$key] == $value){
    //                 $filtered_array[$key] = $array[$key];
    //             }
    //         }
    //     }
    //     return $filtered_array;
    // }
}