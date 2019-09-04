<?php

class Hotel_Model_Phong  extends Default_Model_Common {

    public $_name = "phong";
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getPhongs(&$total, $limit = null, $start = null) 
    {

        
        if (Core_Common_Numeric::isInteger($limit) && Core_Common_Numeric::isInteger($start)) {
            $items = $this->select("*")->order(array('ma_phong'))->limit($limit, $start)->fetchAll();
        } else {
            $items = $this->select("*")->order(array('ma_phong'))->fetchAll();
        }

        $total = $this->select("count(*)")->fetchOne();

        return $items;
    }

    public function getPhong($ma_phong) 
    {
        $item = $this->select("*")->where("ma_phong='$ma_phong'")->fetchRow();
        return $item;
    }

}
