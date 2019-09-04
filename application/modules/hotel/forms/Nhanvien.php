<?php

class Hotel_Form_Nhanvien extends Core_Form {

    public function init() {
        parent::init();
        $this->buildElementsAutoForFormByTableName('nhan_vien');
        $this->getElement('name')->setLabel('Họ và tên: ');
        $this->getElement('phone')->setLabel('phone: ');
        $this->getElement('username')->setLabel('username: ')->setUnique(true,'nhan_vien','id');
        $this->removeElement("type");
        $this->removeElement("password");
        $type = new Core_Form_Element_Select('type');
        $type->setLabel('Loại nhân viên: ')->setRequired();
        $type->addMultiOptions(
                        array(
                            '' => '---Chọn loại nhân viên---',
                            Hotel_Model_Nhanvien::QUAN_TRI => 'Quản trị',
                            Hotel_Model_Nhanvien::LE_TAN => 'Lễ tân',
                            Hotel_Model_Nhanvien::KINH_DOANH => 'Kinh doanh',
                            Hotel_Model_Nhanvien::BUONG_PHONG => 'Buồng phòng',
                            Hotel_Model_Nhanvien::KE_TOAN => 'Kế toán',
                        )
                )
                ->setValue('')->setSeparator(' ');
        $this->addElement($type);
    }

}
