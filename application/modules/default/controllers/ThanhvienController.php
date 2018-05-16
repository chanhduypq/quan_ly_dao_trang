<?php

class ThanhvienController extends Core_Controller_Action {

    public function init() {
        parent::init();
        $this->view->headTitle('Thành viên', true);
        $this->model = new Default_Model_Thanhvien();
        $this->form = new Admin_Form_Thanhvien();
    }

    public function addAction() {
        if ($this->_request->isPost()) {
            $this->form->removeElement("hinh_anh");
        }
        if (isset($_FILES['hinh_anh']['name']) && trim($_FILES['hinh_anh']['name']) != "") {
            
            $temp = explode(".", $_FILES['hinh_anh']['name']);
            $file_name = md5(uniqid(rand(), true)) . '.' . $temp[count($temp) - 1];
            move_uploaded_file($_FILES['hinh_anh']['tmp_name'], "avatar/$file_name");
            $this->formData['hinh_anh'] = $file_name;
        }
        $this->renderScript = 'thanhvien/add.phtml';
    }

    public function editAction() {

        if ($this->_request->isPost()) {
            $this->form->removeElement("hinh_anh");
        }
        if (isset($_FILES['hinh_anh']['name']) && trim($_FILES['hinh_anh']['name']) != "") {
            $temp = explode(".", $_FILES['hinh_anh']['name']);
            $file_name = md5(uniqid(rand(), true)) . '.' . $temp[count($temp) - 1];
            move_uploaded_file($_FILES['hinh_anh']['tmp_name'], "avatar/$file_name");
            $this->formData['hinh_anh'] = $file_name;
            
            $model=new Default_Model_Thanhvien();
            $row=$model->fetchRow('id='.$this->_getParam('id'));
            @unlink("avatar/".$row['hinh_anh']);
        }
        $this->renderScript = 'thanhvien/add.phtml';
    }

    public function deleteAction() {
        $model=new Default_Model_Thanhvien();
        $row=$model->fetchRow('id='.$this->_getParam('id'));
        @unlink("avatar/".$row['hinh_anh']);
    }

    private function cellBorder($objPHPExcel, $cell, $border) {

        $objPHPExcel->getActiveSheet()->getDefaultStyle($cell)->getFill()->applyFromArray(array(
            'borders' => array(
                'allborders' => array(
                    'style' => $border
                )
            )
        ));
    }

    private function cellColor($objPHPExcel, $cell, $color) {

        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => $color
            )
        ));
    }

    private function cellFontColor($objPHPExcel, $cell, $color) {

        $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray(array(
            'font' => array(
                'bold' => FALSE,
                'color' => array('rgb' => $color),
//                'size'  => 15,
                'name' => 'Verdana'
        )));
    }

    private function cellBold($objPHPExcel, $cell) {

        $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray(array(
            'font' => array(
                'bold' => true,
                'name' => 'Verdana'
        )));
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

//        $objPHPExcel->getRowDimension('1')->setRowHeight(-1);
//        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(50);
//        $objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth("12");
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth("18");
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth("18");
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth("18");
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth("18");
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth("18");
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth("18");
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth("28");
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth("18");
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth("18");
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth("18");
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth("26");
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth("26");
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth("26");
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth("26");

        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->getDefaultStyle()->applyFromArray($style);

//        $objPHPExcel->getDefaultStyle()
//                ->getBorders()
//                ->getTop()
//        ->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
// Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'DANH SÁCH THÔNG TIN NHÂN SỰ TỔ THANH NIÊN PHẬT ĐÀ ĐÀ NẴNG')
        ;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:F1");
        $this->cellFontColor($objPHPExcel, 'A1', 'ff3333');
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A3', 'Ngày cập nhật: ')
                ->setCellValue('C3', date('d/m/Y'))
                ->setCellValue('E3', 'TỔNG NAM')
                ->setCellValue('F3', '10')
                ->setCellValue('H3', 'TỔNG NỮ')
                ->setCellValue('I3', '100')
        ;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A3:B3");
        $this->cellFontColor($objPHPExcel, 'A3', '3333ff');
        $this->cellFontColor($objPHPExcel, 'C3', '3333ff');
        $this->cellFontColor($objPHPExcel, 'E3', '3333ff');
        $this->cellFontColor($objPHPExcel, 'F3', '3333ff');
        $this->cellFontColor($objPHPExcel, 'H3', '3333ff');
        $this->cellFontColor($objPHPExcel, 'I3', '3333ff');
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A4', 'STT')
                ->setCellValue('B4', 'Hình ảnh')
                ->setCellValue('C4', 'Họ Tên')
                ->setCellValue('D4', '')
                ->setCellValue('E4', 'Pháp Danh')
                ->setCellValue('F4', 'Năm Sinh')
                ->setCellValue('G4', 'Giới tính')
                ->setCellValue('H4', 'Nghề nghiệp')
                ->setCellValue('I4', 'Email')
                ->setCellValue('J4', 'Facebook')
                ->setCellValue('K4', 'Số CMND')
                ->setCellValue('L4', 'Số điện thoại')
                ->setCellValue('M4', 'Địa chỉ tạm trú')
                ->setCellValue('N4', 'Địa chỉ thường trú')
                ->setCellValue('O4', 'Ngày ĐK tham gia')
                ->setCellValue('P4', 'Người giới thiệu')
        ;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C4:D4');
        $this->cellBold($objPHPExcel, 'A4');
        $this->cellBold($objPHPExcel, 'B4');
        $this->cellBold($objPHPExcel, 'C4');
        $this->cellBold($objPHPExcel, 'D4');
        $this->cellBold($objPHPExcel, 'E4');
        $this->cellBold($objPHPExcel, 'F4');
        $this->cellBold($objPHPExcel, 'G4');
        $this->cellBold($objPHPExcel, 'H4');
        $this->cellBold($objPHPExcel, 'I4');
        $this->cellBold($objPHPExcel, 'J4');
        $this->cellBold($objPHPExcel, 'K4');
        $this->cellBold($objPHPExcel, 'L4');
        $this->cellBold($objPHPExcel, 'M4');
        $this->cellBold($objPHPExcel, 'N4');
        $this->cellBold($objPHPExcel, 'O4');
        $this->cellBold($objPHPExcel, 'P4');

        $sql = "select * from thanh_vien";
        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        $i = 6;
        $stt = 1;
        foreach ($rows as $row) {
            $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(50);
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("A$i", $stt++)
                    ->setCellValue("C$i", html_entity_decode($row['ho']))
                    ->setCellValue("D$i", html_entity_decode($row['ten']))
                    ->setCellValue("E$i", html_entity_decode($row['phap_danh']))
                    ->setCellValue("F$i", html_entity_decode($row['nam_sinh']))
                    ->setCellValue("G$i", html_entity_decode($row['gioi_tinh']))
                    ->setCellValue("H$i", html_entity_decode($row['nghe_nghiep']))
                    ->setCellValue("I$i", html_entity_decode($row['email']))
                    ->setCellValue("J$i", html_entity_decode($row['facebook']))
                    ->setCellValue("K$i", html_entity_decode($row['cmnd']))
                    ->setCellValue("L$i", html_entity_decode($row['dien_thoai']))
                    ->setCellValue("M$i", html_entity_decode($row['dia_chi_tam_tru']))
                    ->setCellValue("N$i", html_entity_decode($row['dia_chi_thuong_tru']))
                    ->setCellValue("O$i", html_entity_decode($row['ngay_dk_tham_gia']))
                    ->setCellValue("P$i", html_entity_decode($row['nguoi_gioi_thieu']));
            if (trim($row['hinh_anh']) != "") {
                $this->insertImage($objPHPExcel, "B$i", $row['hinh_anh']);
            }


            $sheet->getStyle("E$i")->getAlignment()->setWrapText(true);
            $sheet->getStyle("M$i")->getAlignment()->setWrapText(true);
            $sheet->getStyle("N$i")->getAlignment()->setWrapText(true);
            $sheet->getStyle("O$i")->getAlignment()->setWrapText(true);
            $sheet->getStyle("P$i")->getAlignment()->setWrapText(true);
            

//            $this->cellBorder($objPHPExcel, "D$i");
//            $objPHPExcel->setActiveSheetIndex(0)->mergeCells("C$i:D$i");
            $i++;
        }


// Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Danh sách thành viên');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="DANH SÁCH TỔ ĐẠO TRÀNG.xlsx"');
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

    private function insertImage($objPHPExcel, $cell, $value) {
        $objDrawing = new PHPExcel_Worksheet_Drawing();    //create object for Worksheet drawing
        $objDrawing->setName('Customer Signature');        //set name to image
        $objDrawing->setDescription('Customer Signature'); //set description to image
        $signature = "avatar/$value";    //Path to signature .jpg file
        $objDrawing->setPath($signature);
        $objDrawing->setOffsetX(5);                       //setOffsetX works properly
        $objDrawing->setOffsetY(5);                       //setOffsetY works properly
        $objDrawing->setCoordinates($cell);        //set image to cell
        $objDrawing->setWidth(25);                 //set width, height
        $objDrawing->setHeight(50);

        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());  //save
    }

    public function indexAction() {

        $keyword = $this->_getParam('keyword', '');
        $keyword = trim($keyword);
        $type = $this->_getParam('type', 'ten');
        if ($keyword != '') {
            $where = "where $type like '%$keyword%'";
        } else {
            $where = '';
        }
        $sql = "select * from thanh_vien $where";
        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);

        $this->view->items = $rows;
        $this->view->keyword = $keyword;
        $this->view->type = $type;
    }

}
