<?php

class Default_Model_Thanhvien extends Core_Db_Table_Abstract 
{

    public $_name="thanh_vien";    
    public function __construct() 
    {
        parent::__construct();
             
    }
    public function getThanhvien($id) 
    {
        $item = $this->select("*")->where("id=$id")->fetchRow();
        return $item;
    }
    
    

}

?>