<?php

class Hotel_PhongController extends Core_Controller_Action {
    public function init() {
        parent::init();
        $this->model = new Hotel_Model_Phong();
        $this->form = new Hotel_Form_Phong();
        $this->isInputForPrimary = true;
        $this->primaryFieldName = "ma_phong";
        $this->infos = array(
            'ma_phong' => array('label'=>'Mã phòng','width'=>'40'),
            'tang' => array('label'=>'Tầng','width'=>'40'),
        );
    }

    public function indexAction() {
        $rows = $this->model->getPhongs($this->total, $this->limit, $this->start);
        $this->view->items = $rows;
    }

    public function addAction() {
        $this->view->page = $this->_getParam('page');
        $this->renderScript = 'phong/add.phtml';
    }

    public function editAction() {
        $this->view->page = $this->_getParam('page');
        $this->renderScript = 'phong/add.phtml';
    }

}
