<?php 

class Hotel_NhanvienController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $this->model = new Hotel_Model_Nhanvien();
        $this->form = new Hotel_Form_Nhanvien();
        $this->infos = array(
            'name' => array('label'=>'Họ tên','width'=>'40'),
            'username' => array('label'=>'username','width'=>'40'),
        );
    }

    public function indexAction() {
        $rows = $this->model->getNhanViens($this->total, $this->limit, $this->start);
        $this->view->items = $rows;
    }

    public function addAction() {
        if (is_array($this->formData) && count($this->formData) > 0) {
            $this->formData['password'] = sha1($this->formData['username']);
        }
        $this->view->page = $this->_getParam('page');

        $this->renderScript = 'nhanvien/add.phtml';
    }

    public function editAction() {
        $this->view->page = $this->_getParam('page');
        $this->renderScript = 'nhanvien/add.phtml';
    }

}
