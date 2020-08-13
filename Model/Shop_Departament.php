<?php
require("../Utils/UTF8.php");

class Shop_Departament{

    function __construct($shop_id,$departament_id){
        $this->shop_id = (int)$shop_id;
        $this->departament_id = (int)$departament_id;
    }

    public function getShopId()
    {
        return (int)$this->shop_id;
    }

    public function setShopId($shop_id)
    {
        $this->shop_id = (int)$shop_id;

        return $this;
    }

    public function getDepartamentId()
    {
        return (int)$this->departament_id;
    }

    public function setDepartamentId($departament_id)
    {
        $this->departament_id = (int)$departament_id;

        return $this;
    }
}

?>