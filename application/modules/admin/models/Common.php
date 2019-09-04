<?php

class Admin_Model_Common {

    /**
     * 
     * @param array $items
     * @param array $level_1_items
     * @param array $level_2_items
     * @param array $level_3_items
     * @return void Description
     */
    public static function build_array_for_level($items, &$level_1_items, &$level_2_items, &$level_3_items,&$level_4_items) {
        $level_1_items = array();
        foreach ($items as $item) {
            $level_1_items[$item['id']] = array('name_show'=>$item['name_show'], 'is_show_at_home_page' => $item['is_show_at_home_page'],'photo'=>$item['photo'], 'name' => $item['name'], 'has_children' => false);
        }
        $level_2_items = array();
        foreach ($items as $item) {
            if (is_numeric($item['id1'])) {
                $level_2_items[$item['id1']] = array('name_show'=>$item['name_show1'], 'is_show_at_home_page' => $item['is_show_at_home_page1'],'photo'=>$item['photo1'], 'name' => $item['name1'], 'parent_id' => $item['id'], 'has_children' => false);
                $level_1_items[$item['id']]['has_children'] = true;
            }
        }
        $level_3_items = array();
        foreach ($items as $item) {
            if (is_numeric($item['id2'])) {
                $level_3_items[$item['id2']] = array('name_show'=>$item['name_show2'], 'is_show_at_home_page' => $item['is_show_at_home_page2'],'photo'=>$item['photo2'], 'name' => $item['name2'], 'parent_id' => $item['id1'], 'has_children' => false);
                $level_2_items[$item['id1']]['has_children'] = true;
            }
        }
        $level_4_items = array();
        foreach ($items as $item) {
            if (is_numeric($item['id3'])) {
                $level_4_items[$item['id3']] = array('name_show'=>$item['name_show3'], 'is_show_at_home_page' => $item['is_show_at_home_page3'],'photo'=>$item['photo3'], 'name' => $item['name3'], 'parent_id' => $item['id2']);
                $level_3_items[$item['id2']]['has_children'] = true;
            }
        }
    }
    
    /**
     * 
     * @param array $items
     * @param array $level_1_items
     * @param array $level_2_items
     * @param array $level_3_items
     * @return void Description
     */
    public static function build_array_for_level_for_city($items, &$level_1_items, &$level_2_items, &$level_3_items) {
        $level_1_items = array();
        foreach ($items as $item) {
            $level_1_items[$item['id']] = array('name_show'=>$item['name'], 'is_show_at_home_page' => '1','photo'=>'', 'name' => $item['name'], 'has_children' => false);
        }
        $level_2_items = array();
        foreach ($items as $item) {
            if (is_numeric($item['id1'])) {
                $level_2_items[$item['id1']] = array('name_show'=>$item['name1'], 'is_show_at_home_page' => '1','photo'=>'', 'name' => $item['name1'], 'parent_id' => $item['id'], 'has_children' => false);
                $level_1_items[$item['id']]['has_children'] = true;
            }
        }
        $level_3_items = array();
        foreach ($items as $item) {
            if (is_numeric($item['id2'])) {
                $level_3_items[$item['id2']] = array('name_show'=>$item['name2'], 'is_show_at_home_page' => '1','photo'=>'', 'name' => $item['name2'], 'parent_id' => $item['id1']);
                $level_2_items[$item['id1']]['has_children'] = true;
            }
        }
    }

}
