<?php

class Admin_Model_LogoMapper 
{

    public function save($item_image, $dynamic) 
    {
        $data = array();
        $data['file_name'] = $item_image;
        if($dynamic!='-1'){
            $data['dynamic'] = $dynamic;
            $data['show'] = '1';
        }
        else{
            $data['show'] = '0';
        }
        

        try {
            $ret = $this->getDB()->fetchRow("select file_name from logo");
            $file_name = $ret['file_name'];
            if ($file_name == '') {
                $this->getDB()->insert('logo', $data);
            } else {
                if ($item_image == null || trim($item_image == "")) {
                    unset($data['file_name']);
                }
                $this->getDB()->update('logo', $data);
            }
        } catch (Exception $e) {
            return array('success' => false, 'file_name' => $file_name);
        }
        return array('success' => TRUE, 'file_name' => $file_name);
    }
    
    public function save1($dynamic) 
    {
        $data = array();
        if($dynamic!='-1'){
            $data['dynamic'] = $dynamic;
            $data['show'] = '1';
        }
        else{
            $data['show'] = '0';
        }
        

        try {
            $this->getDB()->update('logo', $data);
        } catch (Exception $e) {
        }
    }

    public function getInfo() 
    {
        $ret = array();
        try {
            $ret = $this->getDB()->fetchRow("select * from logo");
        } catch (Exception $e) {
            return array();
        }
        return $ret;
    }

    private function getDB() 
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $db->setFetchMode(Zend_Db::FETCH_ASSOC);
        return $db;
    }

}
