<?php

class ChiasehuynhdeController extends Core_Controller_Action {

    public function init() {
        parent::init();
        
    }

    public function indexAction() {
        $sql = "SELECT * from thanh_vien order by danh_xung,ten_facebook COLLATE utf8_unicode_ci;";                
        $items = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);

        $this->view->items = $items;
        Default_Model_Chiase::getAll($itemChiaSes,$itemChiaSes1);
        $this->view->itemChiaSes = $itemChiaSes;
        $this->view->itemChiaSes1 = $itemChiaSes1;
    }
    
    public function getcontentAction() {
        $this->isAjax();
        $sql = "SELECT * from chiase_thanhvien where thanhvien_id = ".$this->_getParam('id');                
        $items = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        $temp = array();
        foreach ($items as $item){
            $temp[] = $item["chiase_id"];
        }
        echo Zend_Json::encode($temp);
        exit;
    }

    public function editAction() {
        $this->isAjax();
        $data = $this->_getAllParams();
        Zend_Db_Table::getDefaultAdapter()->query("delete from chiase_thanhvien where thanhvien_id = ".$data['thanhvien_id'])->execute();
        $model = new Default_Model_Chiasethanhvien();
        $chiase_ids = explode(",", $data["chiase_ids"]);
        foreach ($chiase_ids as $chiase_id){
            if(is_numeric($chiase_id)&&$chiase_id!="-1"){
                $bind = array(
                        'thanhvien_id' => $data['thanhvien_id'],
                        'chiase_id' => $chiase_id,
                    );
                $model->insert($bind);    
            }
            
        }
        
        exit;
    }
    
}
