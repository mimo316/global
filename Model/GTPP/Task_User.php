<?php
class Task_User
{

    function __construct(
        $task_id,
        $user_id
    ) {
        $this->task_id = (int)$task_id;
        $this->user_id = (int)$user_id;
    }

        public function getTaskId(){
                return $this->task_id;
        }

        public function setTaskId($task_id){
                $this->task_id = (int)$task_id;
                return $this;
        }

        public function getUserId(){
                return $this->user_id;
        }

        public function setUserId($user_id){
                $this->user_id = (int)$user_id;
                return $this;
        }

}
