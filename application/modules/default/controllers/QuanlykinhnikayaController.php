<?php

class QuanlykinhnikayaController extends Core_Controller_Action {

    public function init() {
        parent::init();
        
    }

    public function indexAction() {
        Default_Model_Kinhnikaya::getAll($items,$items1);
        $this->view->items = $items;
        $this->view->items1 = $items1;
    }
    
    public function getitemAction() {
        $this->isAjax();
        echo $this->getItem("kinh_nikaya", $this->_getParam('id'));
        exit;
    }
    
    public function getcontentAction() {
        $this->isAjax();
        echo $this->getContent("kinh_nikaya", $this->_getParam('id'));
        exit;
    }

    public function addAction() {
        $this->isAjax();
        $model = new Default_Model_Kinhnikaya();
        echo $model->add($this->_getAllParams(), $_FILES);
        exit;
    }

    public function editAction() {
        $this->isAjax();
        $model = new Default_Model_Kinhnikaya();
        $model->edit($this->_getAllParams(), $_FILES);
        exit;
    }

    public function deleteAction() {
        $this->isAjax();
        $model = new Default_Model_Kinhnikaya();
        $model->remove($this->_getParam('id', "-1"));
    }
    
    public function downloadAction($path, $fileName = null) {
        Core_Common_Download::download(UPLOAD . "/public/kinh_nikaya/", $this->_getParam("file_name"), $this->_getParam("file_name_fo_show"));
    }
    
    

}
