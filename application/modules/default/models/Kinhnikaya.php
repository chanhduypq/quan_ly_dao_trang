<?php 

class Default_Model_Kinhnikaya extends Default_Model_Common {

    public $_name = "kinh_nikaya";

    public function __construct() {
        parent::__construct();
    }

    public static function getAll(&$items, &$items1) {
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
    }

    public function add($data, $file) {        
        $bind = $this->getData($data);

        if (isset($file['file']) && isset($file['file']['name']) && $file['file']['name'] != '') {
            $item_image = $this->uploadFileForAdd($file['file'], "kinh_nikaya");
            $bind['file_name'] = $item_image;
        }

        $id = $this->insert($bind);
        $this->updateNumberOfChildrenOfParent($parentId = $data['id']);
        return $id;
    }

    public function edit($data, $file) {
        $bind = $this->getData($data, $forAdd = false);
        if (isset($file['file']) && isset($file['file']['name']) && $file['file']['name'] != '') {
            $item_image = $this->uploadFileForEdit($data['id'], $file['file'], "kinh_nikaya");
            $bind['file_name'] = $item_image;
        }
        $this->update($bind, "id=" . $data['id']);
    }

    public function remove($id) {
        $item = $this->fetchRow("id = $id");
        if ($item['file_name'] != "") {
            $path = UPLOAD . "/public/kinh_nikaya/" . $item['file_name'];
            @unlink($path);
        }
        $this->delete("id = $id");
        $this->delete("parent_id = $id");
        
        $this->updateNumberOfChildrenOfParent($parentId = $item["parent_id"]);
    }

}

?>