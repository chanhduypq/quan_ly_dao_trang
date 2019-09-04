<?php

class NoidungchiaseController extends Core_Controller_Action {

    private $keyword = "";
    private $type = "";

    public function init() {
        parent::init();
        $this->view->headTitle('Nội dung chia sẻ', true);
        $this->keyword = $this->_getParam('keyword', '');
        $this->type = $this->_getParam('type', 'title');
    }

    public function canhanAction() {

        $thanhvien_id = $this->getUserId();
        $auth = Zend_Auth::getInstance();
        $identity = $auth->getIdentity();
        if ($identity['is_admin'] == '1') {
            $sql = "select * from chia_se " . $this->getWhere() . " order by title COLLATE utf8_unicode_ci;";
        } else {
            $sql = "select chia_se.id,chia_se.title,chia_se.content from chia_se join chiase_thanhvien on chiase_thanhvien.chiase_id = chia_se.id and thanhvien_id = " . $thanhvien_id . " " . $this->getWhere() . " order by chia_se.title COLLATE utf8_unicode_ci;";
        }

        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);

        $this->view->items = $rows;
        $this->view->table_name = 'chia_se';
        $this->render('data');
    }

    public function kinhnikayaAction() {

        $auth = Zend_Auth::getInstance();
        $identity = $auth->getIdentity();
        if ($identity['is_admin'] == '1') {
            $sql = "select * from kinh_nikaya " . $this->getWhere() . " group by title order by title COLLATE utf8_unicode_ci;";
        } else {
            $this->_helper->redirector('index', 'index', 'default');
            exit;
        }

        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        $this->view->items = $rows;
        $this->view->table_name = 'kinh_nikaya';
        $this->render('data');
    }

    public function dongphapsuphuAction() {
        $sql = "select * from dong_phap_su_phu " . $this->getWhere() . " and is_public = 1 order by title COLLATE utf8_unicode_ci;";
        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);

        $this->view->items = $rows;
        $this->view->table_name = 'dong_phap_su_phu';
        $this->render('data');
    }

    public function canhantreeAction() {

        $thanhvien_id = $this->getUserId();
        $auth = Zend_Auth::getInstance();
        $identity = $auth->getIdentity();
        if ($identity['is_admin'] == '1') {
            $sql = "SELECT * from chia_se where parent_id is null order by title COLLATE utf8_unicode_ci;";
        } else {
            $sql = "select chia_se.id,chia_se.title,chia_se.content,chia_se.number_children from chia_se join chiase_thanhvien on chiase_thanhvien.chiase_id = chia_se.id and thanhvien_id = " . $thanhvien_id . " where is_public = 1 and parent_id is null order by chia_se.title COLLATE utf8_unicode_ci;";
        }

        $item = Core_Db_Table::getDefaultAdapter()->fetchRow($sql);
        if (is_array($item) && count($item) > 0) {
            if ($identity['is_admin'] == '1') {
                $sql = "SELECT * from chia_se where parent_id is null order by title COLLATE utf8_unicode_ci;";
            } else {
                $sql = "select chia_se.id,chia_se.title,chia_se.content,chia_se.number_children from chia_se join chiase_thanhvien on chiase_thanhvien.chiase_id = chia_se.id and thanhvien_id = " . $thanhvien_id . " where is_public = 1 and parent_id is null order by chia_se.title COLLATE utf8_unicode_ci;";
            }

            $items = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        } else {
            $items = array();
        }

        $this->view->items = $items;
    }

    public function kinhnikayatreeAction() {

        $sql = "SELECT * from kinh_nikaya order by title COLLATE utf8_unicode_ci;";
        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        $items = $items1 = array();
        foreach ($rows as $row) {
            if ($row['parent_id'] == "") {
                $items[] = $row;
            } else {
                $items1[] = $row;
            }
        }
        $this->view->items = $items;
        $this->view->items1 = $items1;
    }

    public function dongphapsuphutreeAction() {

        $sql = "SELECT * from dong_phap_su_phu where is_public = 1 order by title COLLATE utf8_unicode_ci;";
        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        $items = $items1 = array();
        foreach ($rows as $row) {
            if ($row['parent_id'] == "") {
                $items[] = $row;
            } else {
                $items1[] = $row;
            }
        }
        $this->view->items = $items;
        $this->view->items1 = $items1;
    }

    public function preDispatch() {
        parent::preDispatch();
        $this->view->keyword = $this->keyword;
        $this->view->type = $this->type;
    }

    private function getWhere() {
        if ($this->keyword != '') {
            if ($this->type == 'all'){
                return "where content <> '' and (title like '%" . $this->keyword . "%' or content like '%" . $this->keyword . "%')";
            }
            else{
                return "where content <> '' and " . $this->type . " like '%" . $this->keyword . "%'";
            }
            
        } else {
            return "where content <> ''";
        }
    }

}
