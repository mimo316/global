<?php
require("../Utils/UTF8.php");
    class SubDepartament{

        function __construct($id,$description,$departament_id){
            $this->id = (int)$id;
            $this->description = utf8ize($description);
            $this->departament_id = (int)$departament_id;
        }

        public function getId(){
                return (int)$this->id;
        }

        public function setId($id){
                $this->id = (int)$id;

                return $this;
        }

        public function getDescription(){
                return utf8_decode($this->description);
        }

        public function setDescription($description){
                $this->description = $description;

                return $this;
        }

        public function getDepartament_id() {
                return (int)$this->departament_id;
        }

        public function setDepartament_id($departament_id){
                $this->departament_id = (int)$departament_id;

                return $this;
        }
    }
?>