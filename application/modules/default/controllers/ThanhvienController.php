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

            $model = new Default_Model_Thanhvien();
            $row = $model->fetchRow('id=' . $this->_getParam('id'));
            @unlink("avatar/" . $row['hinh_anh']);
        }
        $this->renderScript = 'thanhvien/add.phtml';
    }

    public function deleteAction() {
        $model = new Default_Model_Thanhvien();
        $row = $model->fetchRow('id=' . $this->_getParam('id'));
        @unlink("avatar/" . $row['hinh_anh']);
    }

    private function setCellBackgroundColor($objPHPExcel, $cell, $color) {

        $objPHPExcel->getActiveSheet()->getStyle($cell)->getFill()->applyFromArray(array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'startcolor' => array(
                'rgb' => $color
            )
        ));
    }

    /**
     * 
     * @param PHPExcel $objPHPExcel
     * @param string $cell A1, B1,...
     * @param array $style array(
      'bold' => FALSE,
      'color' => array('rgb' => 'ff3333'),
      'size'  => 15,
      'name' => 'Verdana'
      )
     */
    private function setCellStyle($objPHPExcel, $cell, $style) {

        $objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray(array(
            'font' => $style)
        );
    }

    /**
     * 
     * @param PHPExcel $objPHPExcel
     * @param string $cell A1:A10, nếu chỉ là 1 cell A1 thi là A1:A1
     * @param array $border_style array(
      'borders' => array(
      'right' => array(
      'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
      'color' => array('argb' => '766f6e'),
      )
      )
      )
     */
    private function setCellBorder($objPHPExcel, $cell, $border_style) {

        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->getStyle($cell)->applyFromArray($border_style);
    }

    public function exportAction() {
        require_once 'PHPExcel/Classes/PHPExcel.php';
        
        $border_style_all = array(
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
            )
        );


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
//        ->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
// Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'DANH SÁCH THÔNG TIN NHÂN SỰ TỔ THANH NIÊN PHẬT ĐÀ ĐÀ NẴNG')
        ;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:F1");
        $this->setCellStyle($objPHPExcel, 'A1', array(
            'color' => array('rgb' => 'ff3333')
        ));
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A3', 'Ngày cập nhật: ')
                ->setCellValue('C3', date('d/m/Y'))
                ->setCellValue('E3', 'TỔNG NAM')
                ->setCellValue('F3', '10')
                ->setCellValue('H3', 'TỔNG NỮ')
                ->setCellValue('I3', '100')
        ;
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A3:B3");
        $style = array(
            'color' => array('rgb' => '3333ff')
        );
        $this->setCellStyle($objPHPExcel, 'A3', $style);
        $this->setCellStyle($objPHPExcel, 'C3', $style);
        $this->setCellStyle($objPHPExcel, 'E3', $style);
        $this->setCellStyle($objPHPExcel, 'F3', $style);
        $this->setCellStyle($objPHPExcel, 'H3', $style);
        $this->setCellStyle($objPHPExcel, 'I3', $style);
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
        $this->setCellBorder($objPHPExcel, "A4:A4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "B4:B4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "C4:D4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "E4:E4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "F4:F4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "G4:G4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "H4:H4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "I4:I4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "J4:J4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "K4:K4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "L4:L4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "M4:M4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "L4:L4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "N4:N4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "O4:O4", $border_style_all);
        $this->setCellBorder($objPHPExcel, "P4:P4", $border_style_all);
        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C4:D4');
        $style = array(
            'bold' => true
        );
        $this->setCellStyle($objPHPExcel, 'A4', $style);
        $this->setCellStyle($objPHPExcel, 'B4', $style);
        $this->setCellStyle($objPHPExcel, 'C4', $style);
        $this->setCellStyle($objPHPExcel, 'D4', $style);
        $this->setCellStyle($objPHPExcel, 'E4', $style);
        $this->setCellStyle($objPHPExcel, 'F4', $style);
        $this->setCellStyle($objPHPExcel, 'G4', $style);
        $this->setCellStyle($objPHPExcel, 'H4', $style);
        $this->setCellStyle($objPHPExcel, 'I4', $style);
        $this->setCellStyle($objPHPExcel, 'J4', $style);
        $this->setCellStyle($objPHPExcel, 'K4', $style);
        $this->setCellStyle($objPHPExcel, 'L4', $style);
        $this->setCellStyle($objPHPExcel, 'M4', $style);
        $this->setCellStyle($objPHPExcel, 'N4', $style);
        $this->setCellStyle($objPHPExcel, 'O4', $style);
        $this->setCellStyle($objPHPExcel, 'P4', $style);

        $sql = "select * from thanh_vien";
        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        $i = 6;
        $stt = 1;
        $border_style = array(
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
            )
        );
        $border_style1 = array(
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                    'color' => array('argb' => '000000'),
                ),
            )
        );
        
        
        $sum_nam = $sum_nu = 0;
        foreach ($rows as $row) {
            $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(50);
            if (html_entity_decode($row['gioi_tinh']) == 'Nam') {
                $sum_nam++;
            } else {
                $sum_nu++;
            }
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
            $sheet->getStyle("L$i")->getAlignment()->setWrapText(true);

            $this->setCellBorder($objPHPExcel, "A$i:A$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "B$i:B$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "E$i:E$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "F$i:F$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "G$i:G$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "H$i:H$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "I$i:I$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "J$i:J$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "K$i:K$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "L$i:L$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "M$i:M$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "N$i:N$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "O$i:O$i", $border_style_all);
            $this->setCellBorder($objPHPExcel, "P$i:P$i", $border_style_all);

            $this->setCellBorder($objPHPExcel, "D$i:D$i", $border_style);
            $this->setCellBorder($objPHPExcel, "C$i:C$i", $border_style1);
            $i++;
        }

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('F3', $sum_nam)
                ->setCellValue('I3', $sum_nu)
        ;


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
        
        $row= Core_Db_Table::getDefaultAdapter()->fetchRow("select * from columns");
        $this->view->columns = json_decode($row['columns'], true);

        $this->view->items = $rows;
        $this->view->keyword = $keyword;
        $this->view->type = $type;
    }

}
