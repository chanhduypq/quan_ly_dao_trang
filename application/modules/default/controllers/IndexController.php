<?php

class IndexController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $this->view->headTitle('Trang chủ', true);
    }

    public function indexAction() {
        $mapper = new Admin_Model_HomecontentMapper();
        $item = $mapper->getContent();
        $this->view->content = $item['content'];
    }

    public function loginAction() {
        $this->isAjax();
        $data = $this->_request->getPost();
        if (count($data) > 0) {
            $username = $this->_request->getParam('username', null);
            $password = $this->_request->getParam('password', null);
            $index = new Admin_Model_IndexMapper();
            if ($index->login($username, $password)) {
                echo '';
            } else {
                echo 'error';
            }
            exit;
        } else {
            $this->_helper->redirector('index', 'index', 'default');
        }
        exit;
    }

    public function logoutAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $this->_helper->redirector('index', 'index', 'default');
    }

    public function logoutajaxAction() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        exit;
    }

}
