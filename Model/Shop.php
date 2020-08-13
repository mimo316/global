<?php
require('../Utils/UTF8.php');

    class Shop{
       
        function __construct($id,$description,$cnpj,$company_id){
            $this->id = (int)$id;
            $this->description = utf8ize($description);
            $this->cnpj = (int)$cnpj;
            $this->company_id = (int)$company_id;
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

        public function getCNPJ(){
                return (int)$this->cnpj;
        }

        public function setCNPJ($cnpj){
                $this->cnpj = (int)$cnpj;

                return $this;
        }
        
        public function getCompanyId(){
                return (int)$this->company_id;
        }

        public function setCompanyId($company_id){
                $this->company_id = (int)$company_id;

                return $this;
        }
    }
?>