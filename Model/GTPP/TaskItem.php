<?php
require(dirname(__DIR__).'../../Utils/UTF8.php');

class TaskItem{

    function __construct(
        $id,
        $description,
        $check,
        $task_id
    ) {
        $this->id = (int)$id;
        $this->description = utf8ize($description);
        $this->check = (boolean)$check;
        $this->task_id = (int)$task_id;
    }

        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = (int)$id;

                return $this;
        }

        public function getDescription()
        {
                return utf8_decode($this->description);
        }

        public function setDescription($description)
        {
                $this->description = $description;

                return $this;
        }

        public function getCheck()
        {
                return $this->check;
        }

        public function setCheck($check)
        {
                $this->check = (boolean)$check;

                return $this;
        }

        public function getTaskId()
        {
                return $this->task_id;
        }

        public function setTaskId($task_id)
        {
                $this->task_id = (int)$task_id;

                return $this;
        }

}
