<?php

class reader {

    public function __construct() {
        set_time_limit(0);
        set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');

        include 'PHPExcel/Classes/PHPExcel/IOFactory.php';
    }

    public function read($file_name) {
        $objPHPExcel = PHPExcel_IOFactory::load($file_name);
        return $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
    }

}
?>
