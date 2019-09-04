<?php

class Hotel_IndexController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $this->view->headTitle('Trang chủ', true);
    }

    public function indexAction() {
        $this->view->content = '<p style="text-align: center;"><span style="font-size:24px"><span style="color:#008080">CHÚC CÁC BẠN SINH VIÊN THÀNH CÔNG TRONG DỰ ÁN KHÁCH SẠN.</span></span></p>';
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_helper->redirector('index', 'index', 'hotel');
        
        
    }
    
    public function loginAction() {
        $this->isAjax();
        $data = $this->_request->getPost();
        if (count($data) > 0) {
            $username = $this->_request->getParam('username', null);
            $password = $this->_request->getParam('password', null);
            if ($this->login($username, $password)) {
                echo '';
            } else {
                echo 'error';
            }
            exit;
        } else {
            $this->_helper->redirector('index', 'index', 'hotel');
        }
        exit;
    }
    
    public function ajaxchangepasswordAction() 
    {
        $this->isAjax();
        $oldPassword = $this->_getParam('oldPassword',"");
        $auth = Zend_Auth::getInstance();
        $identity = $auth->getIdentity();

        if ($identity['password'] != sha1($oldPassword)) {
            echo 'error';
            exit;
        }
        $newPassword = $this->_getParam('newPassword',"");
        
        $db = Core_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_ASSOC);
        $data = array();
        $data['password'] = sha1($newPassword);
        try {
            $where = $db->quoteInto('username=?', $identity['username'], 'STRING');
            $db->update("nhan_vien", $data, $where);
            $auth = Zend_Auth::getInstance();
            $identity = $auth->getIdentity();
            $identity["password"] = sha1($newPassword);
            $auth->clearIdentity();
            $auth->getStorage()->write($identity);
        } catch (Exception $e) {
            
        }
        
        echo "";
        exit;
    }
    
    private function login($username, $password){
        try {
            $db = Core_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_ASSOC);
            $select = $db->select();
            $select->from("nhan_vien", array("*"))
                    ->where("username=?", $username, "STRING")
                    ->where("password=?", sha1($password), "STRING")
            ;

            $result = $db->fetchRow($select);
        } catch (Exception $e) {
            
        }
        if (!is_array($result) || count($result) == 0) {
            return false;
        }
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $auth->clearIdentity();
        }
        $auth->getStorage()->write($result);
        return true;
    }


}
