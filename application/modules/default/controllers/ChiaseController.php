<?php

class ChiaseController extends Core_Controller_Action {

    public function init() {
        parent::init();
        
    }

    public function indexAction() {
        Default_Model_Chiase::getAll($items,$items1);
        $this->view->items = $items;
        $this->view->items1 = $items1;
    }
    
    public function getitemAction() {
        $this->isAjax();
        echo $this->getItem("chia_se", $this->_getParam('id'));
        exit;
    }
    
    public function getcontentAction() {
        $this->isAjax();
        echo $this->getContent("chia_se", $this->_getParam('id'));
        exit;
    }

    public function addAction() {
        $this->isAjax();
        $model = new Default_Model_Chiase();
        echo $model->add($this->_getAllParams());
        exit;
    }
    
    public function editAction() {
        $this->isAjax();
        $model = new Default_Model_Chiase();
        $model->edit($this->_getAllParams());
        exit;
    }
    
    public function deleteAction() {
        $this->isAjax();
        $model = new Default_Model_Chiase();
        $model->remove($this->_getParam('id'));
    }
    
    

}
