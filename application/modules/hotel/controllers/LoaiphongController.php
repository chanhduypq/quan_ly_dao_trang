<?php

class Hotel_LoaiphongController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $this->model = new Hotel_Model_Loaiphong();
        $this->form = new Hotel_Form_Loaiphong();
        $this->infos = array(
            'name' => array('label'=>'Loại phòng','width'=>'80'),
        );
    }

    public function indexAction() {
        $rows = $this->model->getLoaiPhongs($this->total, $this->limit, $this->start);
        $this->view->items = $rows;
    }

    public function addAction() {
        $this->view->page = $this->_getParam('page');

        $this->renderScript = 'loaiphong/add.phtml';
    }

    public function editAction() {
        $this->view->page = $this->_getParam('page');
        $this->renderScript = 'loaiphong/add.phtml';
    }

}
