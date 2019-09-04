<?php 

class QuanlybaigiangController extends Core_Controller_Action {

    public function init() {
        parent::init();
    }

    public function indexAction() {
        Default_Model_Baigiang::getAll($items,$items1);
        $this->view->items = $items;
        $this->view->items1 = $items1;
    }

    public function getitemAction() {
        $this->isAjax();
        echo $this->getItem("bai_giang", $this->_getParam('id'));
        exit;
    }

    public function getcontentAction() {
        $this->isAjax();
        echo $this->getContent("bai_giang", $this->_getParam('id'));
        exit;
    }

    public function addAction() {
        $this->isAjax();
        $model = new Default_Model_Baigiang();
        echo $model->add($this->_getAllParams(), $_FILES);
        exit;
    }

    public function downloadAction($path, $fileName = null) {
        Core_Common_Download::download(UPLOAD . "/public/bai_giang/", $this->_getParam("file_name"), $this->_getParam("file_name_fo_show") );
    }

    public function editAction() {
        $this->isAjax();
        $model = new Default_Model_Baigiang();
        $model->edit($this->_getAllParams(), $_FILES);
        exit;
    }

    public function deleteAction() {
        $this->isAjax();
        $model = new Default_Model_Baigiang();
        $model->remove($this->_getParam('id',"-1"));
    }

}
