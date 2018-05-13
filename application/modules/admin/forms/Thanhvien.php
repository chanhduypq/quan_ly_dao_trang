<?php 

class Admin_Form_Thanhvien extends Core_Form 
{

    public function init() 
    {
        parent::init();
        $this->buildElementsAutoForFormByTableName('thanh_vien');
        
        $this->getElement('ho_ten')->setLabel('Họ và tên:');
        $this->getElement('phap_danh')->setLabel('Pháp danh:');
        $this->getElement('que_quan')->setLabel('Quê quán:');
        $this->getElement('nam_sinh')->setLabel('Năm sinh:');
        $this->getElement('ngay_sinh')->setLabel('Ngày sinh:');
        $this->getElement('thong_tin_khac')->setLabel('Thông tin khác:');
        
    }
    

}
