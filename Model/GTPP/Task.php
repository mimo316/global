<?php
require(dirname(__DIR__).'../../Utils/UTF8.php');

class Task{

    function __construct(
        $id,
        $description,
        $full_description,
        $initial_date,
        $final_date,
        $state,
        $priority,
        $user_id,
        $shop_id,
        $dept_id,
        $sub_dept_id
    ) {
        $this->id = (int)$id;
        $this->description = utf8ize($description);
        $this->full_description = $full_description;
        $this->initial_date = $initial_date;
        $this->final_date = $final_date;
        $this->state = (int)$state;
        $this->priority = (int)$priority;
        $this->user_id = (int)$user_id;
        if($shop_id == NULL){
            $this->shop_id = $shop_id;
        }else{
            $this->shop_id = (int)$shop_id;
        }
        if($dept_id == NULL){
            $this->dept_id = $dept_id;
        }else{
            $this->dept_id = (int)$dept_id;
        }
        if($sub_dept_id == NULL){
            $this->sub_dept_id = $sub_dept_id;
        }else{
            $this->sub_dept_id = (int)$sub_dept_id;
        }
    }

    public function getId() 
    {
        return (int)$this->id;
    }

    public function setId($id)
    {
        $this->id = (int)$id;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getFullDescription()
    {
        return $this->full_description;
    }

    public function setFullDescription($full_description)
    {
        $this->full_description = $full_description;

        return $this;
    }

    public function getInitialDate()
    {
        return $this->initial_date;
    }

    public function setInitialDate($initial_date)
    {
        $this->initial_date = $initial_date;

        return $this;
    }

    public function getFinalDate()
    {
        return $this->final_date;
    }

    public function setFinalDate($final_date)
    {
        $this->final_date = $final_date;

        return $this;
    }

    public function getState()
    {
        return (int)$this->state;
    }

    public function setState($state)
    {
        $this->state = (int)$state;

        return $this;
    }

    public function getPriority()
    {
        return (int)$this->priority;
    }

    public function setPriority($priority)
    {
        $this->priority = (int)$priority;

        return $this;
    }

    public function getUserId()
    {
        return (int)$this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = (int)$user_id;

        return $this;
    }

    public function getShopId()
    {
        if ($this->shop_id == NULL){
            return $this->shop_id;
        }
        return (int)$this->shop_id;
    }

    public function setShopId($shop_id)
    {
        if($shop_id == NULL){
            return NULL;
        }
        $this->shop_id = (int)$shop_id;

        return $this;
    }

    public function getDeptId()
    {
        if ($this->dept_id == NULL){
            return $this->dept_id;
        }
        return (int)$this->dept_id;
    }

    public function setDeptId($dept_id)
    {
        if($dept_id == NULL){
            return NULL;
        }
        $this->dept_id = (int)$dept_id;

        return $this;
    }

    public function getSubDeptId()
    {
        if ($this->sub_dept_id == NULL){
            return $this->sub_dept_id;
        }
        return (int)$this->sub_dept_id;
    }

    public function setSubDeptId($sub_dept_id)
    {
        if($sub_dept_id == NULL){
            return NULL;
        }
        $this->sub_dept_id = (int)$sub_dept_id;

        return $this;
    }

}
