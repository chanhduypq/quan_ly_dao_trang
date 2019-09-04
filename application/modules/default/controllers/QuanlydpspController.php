<?php 

class QuanlydpspController extends Core_Controller_Action {

    public function init() {
        parent::init();
    }

    public function indexAction() {
        Default_Model_Dongphapsuphu::getAll($items, $items1);
        $this->view->items = $items;
        $this->view->items1 = $items1;
    }

    public function getitemAction() {
        $this->isAjax();
        echo $this->getItem("dong_phap_su_phu", $this->_getParam('id'));
        exit;
    }

    public function getcontentAction() {
        $this->isAjax();
        $sql = "SELECT * from dong_phap_su_phu where id = " . $this->_getParam('id');
        $items = Core_Db_Table::getDefaultAdapter()->fetchRow($sql);
        if ($items['is_tranh_nhan_qua'] == '1' && $items['file_name'] != "") {
            echo '<img style="width:500px;height:auto;object-fit:contain;" src="' . "/tranh_nhan_qua/" . $items['file_name'] . '">';
        } else {
            echo nl2br($items["content"]);
        }

        exit;
    }

    public function addAction() {
        $this->isAjax();
        $model = new Default_Model_Dongphapsuphu();
        echo $model->add($this->_getAllParams(), $_FILES);
        exit;
    }

    public function editAction() {
        $this->isAjax();
        $model = new Default_Model_Dongphapsuphu();
        $model->edit($this->_getAllParams(), $_FILES);
        exit;
    }

    public function deleteAction() {
        $this->isAjax();
        $model = new Default_Model_Dongphapsuphu();
        $model->remove($this->_getParam('id', "-1"));
    }

}
