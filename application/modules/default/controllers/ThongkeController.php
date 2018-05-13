<?php

class ThongkeController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $this->view->headTitle('Thống kê', true);
    }

    public function indexAction() {
        
        
        
        $tu_ngay_quyet_dinh = $this->_getParam('tu_ngay_quyet_dinh', '');
        if ($tu_ngay_quyet_dinh != "") {
            list($d, $m, $y) = explode("/", $tu_ngay_quyet_dinh);
            $tu_ngay_quyet_dinh = "$y-$m-$d";
        }

        $den_ngay_quyet_dinh = $this->_getParam('den_ngay_quyet_dinh', '');
        if ($den_ngay_quyet_dinh != "") {
            list($d, $m, $y) = explode("/", $den_ngay_quyet_dinh);
            $den_ngay_quyet_dinh = "$y-$m-$d";
        }
        
        $where='1=1';
        if($tu_ngay_quyet_dinh!=''){
            $where.=" and ngay_quyet_dinh >= '$tu_ngay_quyet_dinh'";
        }
        if($den_ngay_quyet_dinh!=''){
            $where.=" and ngay_quyet_dinh <= '$den_ngay_quyet_dinh'";
        }
        
        $sql = "select * from du_toan join user on user.id=du_toan.user_id where $where";
        $rows= Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        $this->view->items = $rows;
        $this->view->tu_ngay_quyet_dinh = $this->_getParam('tu_ngay_quyet_dinh', '');
        $this->view->den_ngay_quyet_dinh = $this->_getParam('den_ngay_quyet_dinh', '');
        
        if($this->_getParam('excel', '0')=='1'){
            $this->disableLayout();
            $this->disableRender();

            require_once 'PHPExcel/Classes/PHPExcel.php';
            // Create new PHPExcel object
            $objPHPExcel = new PHPExcel();

            // Set document properties
//            $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
//                                                                     ->setLastModifiedBy("Maarten Balliauw")
//                                                                     ->setTitle("Office 2007 XLSX Test Document")
//                                                                     ->setSubject("Office 2007 XLSX Test Document")
//                                                                     ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
//                                                                     ->setKeywords("office 2007 openxml php")
//                                                                     ->setCategory("Test result file");


            // Add some data
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'Số quyết định')
                        ->setCellValue('B1', 'Ngày tháng')
                        ->setCellValue('C1', 'Nội dung dự toán')
                        ->setCellValue('D1', 'Giá trị dự toán')
                        ->setCellValue('E1', 'Người phụ trách')
                    ;
            $rowCount = 1;
            $sum = 0;
            foreach ($rows as $row) {
                $sum += $row['tong_tien'];
                $rowCount++;
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $rowCount, $row['so_quyet_dinh']);
                list($date, $time) = explode(" ", $row['ngay_quyet_dinh']);
                list($y, $m, $d) = explode("-", $date);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $rowCount, "$d/$m/$y");
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $rowCount, $row['noi_dung_quyet_dinh']);
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $rowCount, number_format($row['tong_tien'], 0, ",", "."));
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E' . $rowCount, $row['danh_xung'] . ' ' . $row['full_name']);
            }
            
            $rowCount++;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $rowCount, number_format($sum, 0, ",", "."));

            // Rename worksheet
            $objPHPExcel->getActiveSheet()->setTitle('Dự toán');


            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex(0);


            // Redirect output to a client’s web browser (Excel5)
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="thong_ke_du_toan.xls"');
            header('Cache-Control: max-age=0');
            // If you're serving to IE 9, then the following may be needed
            header('Cache-Control: max-age=1');

            // If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
            header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0

            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            $objWriter->save('php://output');
            exit;
        }
    }
    
}
