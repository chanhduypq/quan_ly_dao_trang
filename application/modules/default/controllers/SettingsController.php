<?php

class SettingsController extends Core_Controller_Action 
{

    public function init() 
    {
        parent::init();
    }

    public function indexAction() 
    {
        if ($this->_request->isPost()) {
            $data = $this->_request->getPost();
            $columns= json_encode($data['columns']);
            Core_Db_Table::getDefaultAdapter()->update('columns', array('columns'=>$columns));
            Core::message()->addSuccess('Lưu thành công');
        }
        
        $row= Core_Db_Table::getDefaultAdapter()->fetchRow("select * from columns");
        $this->view->columns = json_decode($row['columns'], true);
    }

}
