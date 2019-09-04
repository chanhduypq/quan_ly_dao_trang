<?php

class Hotel_Form_Phong extends Core_Form {

    public function init() {
        parent::init();
        $this->buildElementsAutoForFormByTableName('phong');
        $validatorMax = new Zend_Validate_LessThan(array('max' => 6));
        $validatorMax->setMessage("Vui lòng nhập số nhỏ hơn 6");
        $validatorMin = new Zend_Validate_GreaterThan(array('min' => 0));
        $validatorMin->setMessage("Vui lòng nhập số lớn hơn 0");

        $this->getElement('tang')->setLabel('Tầng: ');
        $this->getElement('phone')->setLabel('phone: ');
        $this->getElement('so_giuong')
                ->setLabel('Số giường: ')
                ->addValidators(
                        array(
                            $validatorMax,
                            $validatorMin
                        )
                )
        ;
        $this->getElement('so_nguoi')
                ->setLabel('Số người: ')
                ->addValidators(
                        array(
                            $validatorMax,
                            $validatorMin
                        )
                )
        ;
        $this->getElement('phone')->setLabel('phone: ');
        $this->getElement('ma_phong')->setLabel('Mã phòng: ')->addValidator('Db_NoRecordExists', true, array('table' => 'phong', 'field' => 'ma_phong'));
        $this->getElement('ma_phong')->getValidator('Db_NoRecordExists')->setMessage('Mã phòng này đã tồn tại rồi.');
        $this->removeElement("loaiphong_id");

        $this->removeElement("status");

        $loaiphong_id = new Core_Form_Element_Select('loaiphong_id');
        $loaiphong_id->setLabel('Loại phòng: ')->setRequired();
        $loaiPhongs = $this->getLoaiPhongs();
        $loaiphong_id->addMultiOptions($loaiPhongs)->setValue('')->setSeparator(' ');
        $validateInArray = new Zend_Validate_InArray(array(
                                                            'haystack' => array_keys($loaiPhongs)
                                                            )
        );
        $validateInArray->setMessage('Loại phòng vừa bị xóa rồi.');
        $loaiphong_id->addValidator($validateInArray);
        $this->addElement($loaiphong_id);
    }

    private function getLoaiPhongs() {
        $model = new Hotel_Model_Loaiphong();
        $items = $model->getLoaiPhongs($total);
        $loaiPhongs[''] = '---Chọn loại phòng---';
        foreach ($items as $item) {
            $loaiPhongs[$item['id']] = html_entity_decode($item['name']);
        }
        return $loaiPhongs;
    }

}
