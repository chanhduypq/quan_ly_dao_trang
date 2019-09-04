<?php

class Hotel_Model_Nhanvien  extends Default_Model_Common {

    public $_name = "nhan_vien";
    
    const QUAN_TRI = '0';
    const LE_TAN = '1';
    const KINH_DOANH = '2';
    const BUONG_PHONG = '3';
    const KE_TOAN = '4';
    
    const permistion = array(
        Hotel_Model_Nhanvien::QUAN_TRI => array(
                                            'index' => array(
                                                            'index',
                                                            ),
                                            'nhanvien' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                            'phong' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                            'loaiphong' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                        ),
        Hotel_Model_Nhanvien::LE_TAN => array(
                                            'index' => array(
                                                            'index',
                                                            ),
                                            'nhanvien' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                            'phong' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                            'loaiphong' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                        ),
        Hotel_Model_Nhanvien::KINH_DOANH => array(
                                            'index' => array(
                                                            'index',
                                                            ),
                                            'nhanvien' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                            'phong' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                            'loaiphong' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                        ),
        Hotel_Model_Nhanvien::BUONG_PHONG => array(
                                            'index' => array(
                                                            'index',
                                                            ),
                                            'nhanvien' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                            'phong' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                            'loaiphong' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                        ),
        Hotel_Model_Nhanvien::KE_TOAN => array(
                                            'index' => array(
                                                            'index',
                                                            ),
                                            'nhanvien' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                            'phong' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                            'loaiphong' => array(
                                                            'add',
                                                            'delete',
                                                            'edit',
                                                            'index',
                                                            ),
                                        ),
    );

    public function __construct() {
        parent::__construct();
    }
    
    

    public function getNhanViens(&$total, $limit = null, $start = null) {
        if (Core_Common_Numeric::isInteger($limit) && Core_Common_Numeric::isInteger($start)) {
            $items = $this->select("*")->order(array('id'))->limit($limit, $start)->fetchAll();
        } else {
            $items = $this->select("*")->order(array('id'))->fetchAll();
        }

        $total = $this->select("count(*)")->fetchOne();

        return $items;
    }

    public function getNhanVien($id) {
        $item = $this->select("*")->where("id=$id")->fetchRow();
        return $item;
    }

}
