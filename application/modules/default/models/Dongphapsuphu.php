<?php 

class Default_Model_Dongphapsuphu extends Default_Model_Common {

    public $_name = "dong_phap_su_phu";

    public function __construct() {
        parent::__construct();
    }

    public static function getAll(&$items, &$items1) {
        $sql = "SELECT * from dong_phap_su_phu order by title COLLATE utf8_unicode_ci;";
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
            $fileName = $this->uploadFileForAdd($file['file'], "tranh_nhan_qua");
            $bind['file_name'] = $fileName;
        }

        $id = $this->insert($bind);
        $this->updateNumberOfChildrenOfParent($parentId = $data['id']);
        return $id;
    }

    public function edit($data, $file) {
        $bind = $this->getData($data, $forAdd = false);
        if (isset($file['file']) && isset($file['file']['name']) && $file['file']['name'] != '') {
            $fileName = $this->uploadFileForEdit($data['id'], $file['file'], "tranh_nhan_qua");
            $bind['file_name'] = $fileName;
        }
        $this->update($bind, "id=" . $data['id']);
    }

    public function remove($id) {
        $item = $this->fetchRow("id = $id");
        if ($item['file_name'] != "") {
            $path = UPLOAD . "/public/tranh_nhan_qua/" . $item['file_name'];
            @unlink($path);
        }

        $this->delete("id = $id");
        $this->delete("parent_id = $id");

        $this->updateNumberOfChildrenOfParent($parentId = $item["parent_id"]);
    }

}

?>