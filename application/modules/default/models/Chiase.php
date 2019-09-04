<?php 

class Default_Model_Chiase extends Default_Model_Common {

    public $_name = "chia_se";

    public function __construct() {
        parent::__construct();
    }

    public static function getAll(&$items, &$items1) {
        $sql = "SELECT * from chia_se order by title COLLATE utf8_unicode_ci;";
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

    public function add($data) {
        $bind = $this->getData($data);

        $id = $this->insert($bind);
        $this->updateNumberOfChildrenOfParent($parentId = $data['id']);
        return $id;
    }

    public function edit($data) {
        $bind = $this->getData($data, $forAdd = false);
        $this->update($bind, "id=" . $data['id']);
    }

    public function remove($id) {
        $item = $this->fetchRow("id = $id");
        $this->delete("id = $id");
        $this->delete("parent_id = $id");
        $this->updateNumberOfChildrenOfParent($parentId = $item["parent_id"]);
    }

}

?>