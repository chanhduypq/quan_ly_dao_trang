<?php 
/**
 * @author Trần Công Tuệ <chanhduypq@gmail.com>
 */
class Core_Common_Excel {

    private $fileNameForExport = "excel.xlsx";
    private $titleFile = "";
    private $sheetName = "Sheet0";
    private $objPHPExcel;
    private $rows = array();
    /**
     *
     * @var array 
     * array(
            'E'=>'50',
            'H'=>'30',
            ) 
     * cột E có độ rộng 50, cột H có độ rộng 30
     */
    private $widthColumns = array();
    public function getWidthColumns() {
        return $this->widthColumns;
    }

    public function setWidthColumns($widthColumns) {
        $this->widthColumns = $widthColumns;
    }

        public function getFileNameForExport() {
        return $this->fileNameForExport;
    }

    public function setFileNameForExport($fileNameForExport) {
        $fileNameForExport = rtrim($fileNameForExport, ".xlsx");
        $fileNameForExport = rtrim($fileNameForExport, ".xls");
        $fileNameForExport .= ".xlsx";
        $this->fileNameForExport = $fileNameForExport;
    }
    public function getRows() {
        return $this->rows;
    }

    public function setRows($rows) {
        $this->rows = $rows;
    }

        public function getTitleFile() {
        return $this->titleFile;
    }

    public function setTitleFile($titleFile) {
        $this->titleFile = $titleFile;
    }

    public function getSheetName() {
        return $this->sheetName;
    }

    public function setSheetName($sheetName) {
        $this->sheetName = $sheetName;
    }
    public function getObjPHPExcel() {
        return $this->objPHPExcel;
    }

    public function setObjPHPExcel($objPHPExcel) {
        $this->objPHPExcel = $objPHPExcel;
    }

        public function __construct() {
        require_once 'PHPExcel/Classes/PHPExcel.php';
        $this->objPHPExcel = new PHPExcel();
    }

    private function setCellBackgroundColor($cell, $color) {

        $this->objPHPExcel->getActiveSheet()->getStyle($cell)->getFill()->applyFromArray(array(
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
    private function setCellStyle($cell, $style) {

        $this->objPHPExcel->getActiveSheet()->getStyle($cell)->applyFromArray(array(
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
    public function setCellBorder($cell, $border_style) {

        $sheet = $this->objPHPExcel->getActiveSheet();
        $sheet->getStyle($cell)->applyFromArray($border_style);
    }

    public function getBorderStyleAll() {
        $borderStyleAll = array(
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
        return $borderStyleAll;
    }

    public function export() {
        $borderStyleAll = $this->getBorderStyleAll();

// Set document properties
        $this->objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                ->setLastModifiedBy("Maarten Balliauw")
                ->setTitle("Office 2007 XLSX Test Document")
                ->setSubject("Office 2007 XLSX Test Document")
                ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
                ->setKeywords("office 2007 openxml php")
                ->setCategory("Test result file");

//        $this->objPHPExcel->getRowDimension('1')->setRowHeight(-1);
//        $this->objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(50);
//        $this->objPHPExcel->getDefaultStyle()->getAlignment()->setWrapText(true);

        foreach ($this->getWidthColumns() as $key => $value){
            $this->objPHPExcel->getActiveSheet()->getColumnDimension($key)->setWidth($value);
        }

        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $sheet = $this->objPHPExcel->getActiveSheet();
        $sheet->getDefaultStyle()->applyFromArray($style);

//        $this->objPHPExcel->getDefaultStyle()
//                ->getBorders()
//                ->getTop()
//        ->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
// Add some data
        $this->objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', $this->getTitleFile())
        ;

        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells("A1:F1");
        $this->setCellStyle('A1', array(
            'color' => array('rgb' => 'ff3333')
        ));
        
        $style = array(
            'color' => array('rgb' => '3333ff')
        );
        $this->setCellStyle('A3', $style);
        $this->setCellStyle('C3', $style);
        $this->setCellStyle('E3', $style);
        $this->setCellStyle('F3', $style);
        $this->setCellStyle('H3', $style);
        $this->setCellStyle('I3', $style);
        
        $this->setCellBorder("A4:A4", $borderStyleAll);
        $this->setCellBorder("B4:B4", $borderStyleAll);
        $this->setCellBorder("C4:D4", $borderStyleAll);
        $this->setCellBorder("E4:E4", $borderStyleAll);
        $this->setCellBorder("F4:F4", $borderStyleAll);
        $this->setCellBorder("G4:G4", $borderStyleAll);
        $this->setCellBorder("H4:H4", $borderStyleAll);
        $this->setCellBorder("I4:I4", $borderStyleAll);
        $this->setCellBorder("J4:J4", $borderStyleAll);
        $this->setCellBorder("K4:K4", $borderStyleAll);
        $this->setCellBorder("L4:L4", $borderStyleAll);
        $this->setCellBorder("M4:M4", $borderStyleAll);
        $this->setCellBorder("L4:L4", $borderStyleAll);
        $this->setCellBorder("N4:N4", $borderStyleAll);
        $this->setCellBorder("O4:O4", $borderStyleAll);
        $this->setCellBorder("P4:P4", $borderStyleAll);
        $this->objPHPExcel->setActiveSheetIndex(0)->mergeCells('C4:D4');
        $style = array(
            'bold' => true
        );
        $this->setCellStyle('A4', $style);
        $this->setCellStyle('B4', $style);
        $this->setCellStyle('C4', $style);
        $this->setCellStyle('D4', $style);
        $this->setCellStyle('E4', $style);
        $this->setCellStyle('F4', $style);
        $this->setCellStyle('G4', $style);
        $this->setCellStyle('H4', $style);
        $this->setCellStyle('I4', $style);
        $this->setCellStyle('J4', $style);
        $this->setCellStyle('K4', $style);
        $this->setCellStyle('L4', $style);
        $this->setCellStyle('M4', $style);
        $this->setCellStyle('N4', $style);
        $this->setCellStyle('O4', $style);
        $this->setCellStyle('P4', $style);

        
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


//        $sum_nam = $sum_nu = 0;
//        foreach ($this->getRows() as $row) {
//            $this->objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(50);
//            if (html_entity_decode($row['gioi_tinh']) == 'Nam') {
//                $sum_nam++;
//            } else {
//                $sum_nu++;
//            }
//            $this->objPHPExcel->setActiveSheetIndex(0)
//                    ->setCellValue("A$i", $stt++)
//                    ->setCellValue("C$i", html_entity_decode($row['ho']))
//                    ->setCellValue("D$i", html_entity_decode($row['ten']))
//                    ->setCellValue("E$i", html_entity_decode($row['phap_danh']))
//                    ->setCellValue("F$i", html_entity_decode($row['nam_sinh']))
//                    ->setCellValue("G$i", html_entity_decode($row['gioi_tinh']))
//                    ->setCellValue("H$i", html_entity_decode($row['nghe_nghiep']))
//                    ->setCellValue("I$i", html_entity_decode($row['email']))
//                    ->setCellValue("J$i", html_entity_decode($row['facebook']))
//                    ->setCellValue("K$i", html_entity_decode($row['cmnd']))
//                    ->setCellValue("L$i", html_entity_decode($row['dien_thoai']))
//                    ->setCellValue("M$i", html_entity_decode($row['dia_chi_tam_tru']))
//                    ->setCellValue("N$i", html_entity_decode($row['dia_chi_thuong_tru']))
//                    ->setCellValue("O$i", html_entity_decode($row['ngay_dk_tham_gia']))
//                    ->setCellValue("P$i", html_entity_decode($row['nguoi_gioi_thieu']));
//            if (trim($row['hinh_anh']) != "") {
//                $this->insertImage("B$i", $row['hinh_anh']);
//            }
//
//
//            $sheet->getStyle("E$i")->getAlignment()->setWrapText(true);
//            $sheet->getStyle("M$i")->getAlignment()->setWrapText(true);
//            $sheet->getStyle("N$i")->getAlignment()->setWrapText(true);
//            $sheet->getStyle("O$i")->getAlignment()->setWrapText(true);
//            $sheet->getStyle("P$i")->getAlignment()->setWrapText(true);
//            $sheet->getStyle("L$i")->getAlignment()->setWrapText(true);
//
//            $this->setCellBorder("A$i:A$i", $borderStyleAll);
//            $this->setCellBorder("B$i:B$i", $borderStyleAll);
//            $this->setCellBorder("E$i:E$i", $borderStyleAll);
//            $this->setCellBorder("F$i:F$i", $borderStyleAll);
//            $this->setCellBorder("G$i:G$i", $borderStyleAll);
//            $this->setCellBorder("H$i:H$i", $borderStyleAll);
//            $this->setCellBorder("I$i:I$i", $borderStyleAll);
//            $this->setCellBorder("J$i:J$i", $borderStyleAll);
//            $this->setCellBorder("K$i:K$i", $borderStyleAll);
//            $this->setCellBorder("L$i:L$i", $borderStyleAll);
//            $this->setCellBorder("M$i:M$i", $borderStyleAll);
//            $this->setCellBorder("N$i:N$i", $borderStyleAll);
//            $this->setCellBorder("O$i:O$i", $borderStyleAll);
//            $this->setCellBorder("P$i:P$i", $borderStyleAll);
//
//            $this->setCellBorder("D$i:D$i", $border_style);
//            $this->setCellBorder("C$i:C$i", $border_style1);
//            $i++;
//        }
//
//        $this->objPHPExcel->setActiveSheetIndex(0)
//                ->setCellValue('F3', $sum_nam)
//                ->setCellValue('I3', $sum_nu)
//        ;


        // Rename worksheet
        $this->objPHPExcel->getActiveSheet()->setTitle($this->getSheetName());
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $this->objPHPExcel->setActiveSheetIndex(0);
        // Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $this->getFileNameForExport() . '"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($this->objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    public function insertImage($cell, $value) {
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

        $objDrawing->setWorksheet($this->objPHPExcel->getActiveSheet());  //save
    }

}
