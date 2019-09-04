<?php

class Hotel_Model_Loaiphong  extends Default_Model_Common {

    public $_name = "loai_phong";
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getLoaiPhongs(&$total, $limit = null, $start = null) 
    {

        $db = Core_Db_Table::getDefaultAdapter();
        if (Core_Common_Numeric::isInteger($limit) && Core_Common_Numeric::isInteger($start)) {
            $items = $db->fetchAll("SELECT DISTINCT loai_phong.id, loai_phong.name, phong.loaiphong_id from loai_phong LEFT JOIN phong on phong.loaiphong_id=loai_phong.id order by loai_phong.id limit $start,$limit");
        } else {
            $items = $db->fetchAll("SELECT DISTINCT loai_phong.id, loai_phong.name, phong.loaiphong_id from loai_phong LEFT JOIN phong on phong.loaiphong_id=loai_phong.id order by loai_phong.id");
        }

        $total = $this->select("count(*)")->fetchOne();

        return $items;
    }

    public function getLoaiPhong($id) 
    {
        $item = $this->select("*")->where("id=$id")->fetchRow();
        return $item;
    }

}
