<?php   
    require('../Utils/UTF8.php');
    
    class User{
        
        function __construct($id,$user,$password,$status){
                $this->id = (int)$id;
                $this->user = utf8ize($user); 
                $this->password = utf8ize($password);  
                $this->status = (int)$status;
        }

        public function getId(){
                return (int)$this->id;
        }

        public function setId($id){
                $this->id = (int)$id;

                return $this;
        }

        public function getUser(){
                return $this->user;
        }
 
        public function setUser($user){
                $this->user = $user;

                return $this;
        }

        public function getPassword(){
                return utf8_decode($this->password);
        }

        public function setPassword($password){
                $this->password = $password;

                return $this;
        }

        public function getStatus(){
                return (int)$this->status;
        }

        public function setStatus($status){
                $this->status = (int)$status;

                return $this;
        }
    }
?>