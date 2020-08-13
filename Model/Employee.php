<?php
require("../Utils/UTF8.php");

    class Employee{
        
        function __construct($id,$name,$sub_id,$shop_id){
                $this->id = (int)$id;
                $this->name = utf8ize($name); 
                $this->sub_id = (int)$sub_id;  
                $this->shop_id = (int)$shop_id;
        }
    
        public function getId(){
                return (int)$this->id;
        }

        public function setId($id){
                $this->id = (int)$id;
                return $this;
        }

        public function getName(){
                return utf8_decode($this->name);
        }

        public function setName($name){
                $this->name = $name;
                return $this;
        }

        public function getSubId(){
                return (int)$this->sub_id;
        }

        public function setSubId($sub_id){
                $this->sub_id = (int)$sub_id;
                return $this;
        }

        public function getShopId(){
                return (int)$this->shop_id;
        }

        public function setShopId($shop_id){
                $this->shop_id = (int)$shop_id;
                return $this;
        }
    }
?>