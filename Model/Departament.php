<?php
require("../Utils/UTF8.php");

    class Departament{

        function __construct($id,$description){
            $this->id = (int)$id;
            $this->description = utf8ize($description);
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
    }
?>