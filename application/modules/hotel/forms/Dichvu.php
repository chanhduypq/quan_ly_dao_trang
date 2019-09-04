<?php

class Hotel_Form_Dichvu extends Core_Form {

    public function init() {
        parent::init();
        $this->buildElementsAutoForFormByTableName('dich_vu');
        $this->getElement('name')->setLabel('Tên dịch vụ: ')->setUnique(true,'loai_phong','id');
    }

}
