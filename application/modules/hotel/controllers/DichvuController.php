<?php

class Hotel_DichvuController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $this->model = new Hotel_Model_Dichvu();
        $this->form = new Hotel_Form_Dichvu();
        $this->infos = array(
            'name' => array('label'=>'Tên dịch vụ','width'=>'80'),
        );
    }

    public function indexAction() {
        $rows = $this->model->getDichvus($this->total, $this->limit, $this->start);
        $this->view->items = $rows;
    }

    public function addAction() {
        $this->view->page = $this->_getParam('page');

        $this->renderScript = 'dichvu/add.phtml';
    }

    public function editAction() {
        $this->view->page = $this->_getParam('page');
        $this->renderScript = 'dichvu/add.phtml';
    }

}
