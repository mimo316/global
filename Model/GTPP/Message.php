<?php
require(dirname(__DIR__).'../../Utils/UTF8.php');

class Message{

    function __construct(
        $id,
        $description,
        $date_time,
        $task_id,
        $user_id
    ) {
        $this->id = (int)$id;
        $this->description = utf8ize($description);
        $this->date_time = $date_time;
        $this->task_id = (int)$task_id;
        $this->user_id = (int)$user_id;
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

        public function getDateTime()
        {
                return $this->date_time;
        }

        public function setDateTime($date_time)
        {
                $this->date_time = $date_time;

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

        public function getUserId()
        {
                return $this->user_id;
        }

        public function setUserId($user_id)
        {
                $this->user_id = (int)$user_id;

                return $this;
        }
}
