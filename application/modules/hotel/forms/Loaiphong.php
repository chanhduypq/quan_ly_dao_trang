<?php

class Hotel_Form_Loaiphong extends Core_Form {

    public function init() {
        parent::init();
        $this->buildElementsAutoForFormByTableName('loai_phong');
        $this->getElement('name')->setLabel('Loại phòng: ')->setUnique(true,'loai_phong','id');
    }

}
