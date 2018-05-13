<?php

class Admin_UserController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $this->model = new Default_Model_User();
        $this->form = new Admin_Form_User();
    }

    public function indexAction() {
        $rows = $this->model->getUsers($this->total, $this->limit, $this->start);
        $this->view->items = $rows;
    }

    public function addAction() {
        if (is_array($this->formData) && count($this->formData) > 0) {
            $this->formData['password'] = sha1($this->formData['email']);
        }
        $this->view->page = $this->_getParam('page');

        $this->renderScript = 'user/add.phtml';
    }

    public function editAction() {
        $this->view->page = $this->_getParam('page');

        $db = Core_Db_Table::getDefaultAdapter();
        $id = $this->_getParam('id');

        $this->renderScript = 'user/add.phtml';
    }

    public function deleteAction() {
    }

    public function allowreexamAction() {
        $user_id = $this->_request->getParam('user_id', null);
        $exam_id = $this->_request->getParam('exam_id', null);
        $db = Core_Db_Table::getDefaultAdapter();
        $db->query('UPDATE user_exam SET allow_re_exam=1 WHERE id=' . $exam_id)->execute();
        $this->_helper->redirector('edit', 'user', 'admin', array('id' => $user_id));
    }

    public function cancelreexamAction() {
        $user_id = $this->_request->getParam('user_id', null);
        $exam_id = $this->_request->getParam('exam_id', null);
        $db = Core_Db_Table::getDefaultAdapter();
        $db->query('UPDATE user_exam SET allow_re_exam=0 WHERE id=' . $exam_id)->execute();
        $this->_helper->redirector('edit', 'user', 'admin', array('id' => $user_id));
    }

    public function ketquathiAction() {
        $user_exam_id = $this->_getParam('user_exam_id');
        $html = Default_Model_Userexam::getHtmlForExamResult($user_exam_id, $title_header);

        $db = Core_Db_Table::getDefaultAdapter();
        $row = $db->fetchRow("select "
                . "DATE_FORMAT(user_exam.exam_date,'%Y_%m_%d') AS date,"
                . "user.id "
                . "from user_exam "
                . "JOIN user ON user.id=user_exam.user_id "
                . "WHERE user_exam.id=$user_exam_id");

        Core_Common_Pdf::createFilePdf(Core_Common_Pdf::DOWNLOAD, $html, $row['id'] . '___' . $row['date'] . '.pdf', $title_header);
    }

}
