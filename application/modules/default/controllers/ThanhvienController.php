<?php

class ThanhvienController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $this->view->headTitle('Thành viên', true);
        $this->model = new Default_Model_Thanhvien();
        $this->form = new Admin_Form_Thanhvien();
    }

    public function addAction() {
        $this->renderScript = 'thanhvien/add.phtml';
    }

    public function editAction() {

        $db = Core_Db_Table::getDefaultAdapter();
        $id = $this->_getParam('id');

        $this->renderScript = 'thanhvien/add.phtml';
    }

    public function deleteAction() {
        
    }

    public function exportAction() {
        require_once 'PHPExcel/Classes/PHPExcel.php';


// Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

// Set document properties
        $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                ->setLastModifiedBy("Maarten Balliauw")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");


// Add some data
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Họ và tên')
            ->setCellValue('B1', 'Pháp danh')
            ->setCellValue('C1', 'Năm sinh')
            ->setCellValue('D1', 'Ngày sinh')
            ->setCellValue('E1', 'Ngày sinh')
            ->setCellValue('F1', 'Thông tin khác')
            ;
        $sql = "select *,DATE_FORMAT(ngay_sinh,'%d/%m/%Y') AS ngay_sinh_vn from thanh_vien";
        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        $i=2;
        foreach ($rows as $row){
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue("A$i", html_entity_decode($row['ho_ten']))
                ->setCellValue("B$i", html_entity_decode($row['phap_danh']))
                ->setCellValue("C$i", html_entity_decode($row['que_quan']))
                ->setCellValue("D$i", $row['nam_sinh'])
                ->setCellValue("E$i", $row['ngay_sinh_vn'])
                ->setCellValue("F$i", html_entity_decode($row['thong_tin_khac']));
            $i++;
        }


// Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Danh sách thành viên');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="01simple.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    public function indexAction() {

        $keyword = $this->_getParam('keyword', '');
        $keyword = trim($keyword);
        $type = $this->_getParam('type', 'que_quan');
        if ($keyword != '') {
            $where = "where $type like '%$keyword%'";
            if ($type == 'nam_sinh') {
                if (is_numeric(str_replace(".", "", $keyword))) {
                    $where = "where $type ='" . str_replace(".", "", $keyword) . "'";
                } else {
                    $where = 'where 1=0';
                }
            }
        } else {
            $where = '';
        }
        $sql = "select *,DATE_FORMAT(ngay_sinh,'%d/%m/%Y') AS ngay_sinh_vn from thanh_vien $where";
        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);

        $this->view->items = $rows;
        $this->view->keyword = $keyword;
        $this->view->type = $type;
    }

}
