<?php 
/**
 * @author Trần Công Tuệ <chanhduypq@gmail.com>
 */
class Core_Common_Array {

    /**
     * function common
     * sắp xếp lại mảng
     * ví dụ: a 1, a 2,..., a 11 chứ không phải a 1, a 11, a 2,...
     * @param array $array
     * @return void
     * @author Trần Công Tuệ <chanhduypq@gmail.com>
     */
    public static function sort(&$array, $keyForSort, $valueForSort) {
        $keyForSort = trim($keyForSort);
        $temps = array();
        for ($i = 0; $i < count($array); $i++) {
            foreach ($array as $key => $value) {
                $temp1 = $value[$keyForSort];
                $temp2 = "$valueForSort " . ($i + 1);
                $s1 = mb_detect_encoding($temp1, "UTF-8");
                $s2 = mb_detect_encoding($temp2, "UTF-8");
                if ($value[$keyForSort] == "$valueForSort " . ($i + 1) && $value['parent_id'] != "201") {
                    $temps[] = $value;
                } else if ($s1 == $s2 && $value['parent_id'] == "201") {
                    $temps[] = $value;
                }
            }
        }
        $array = $temps;
    }

}
