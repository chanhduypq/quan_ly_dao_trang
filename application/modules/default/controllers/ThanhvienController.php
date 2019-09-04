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
            if ($this->_getParam('reset_password') == '1' || (isset($this->formData['dien_thoai']) && trim($this->formData['dien_thoai']) != "" && $this->formData['password'] == "")) {
                $this->formData['password'] = sha1($this->formData['dien_thoai']);
            }
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


    public function exportAction() {
        $sql = "select * from thanh_vien";
        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        $excel = new Core_Common_Excel();
        $excel->setFileNameForExport("123");
        $excel->setSheetName("danh sách");
        $excel->setRows($rows);
        $excel->setWidthColumns(array(
            'E'=>'50',
            'H'=>'30',
            ));
        $excel->getObjPHPExcel()->setActiveSheetIndex(0)
                ->setCellValue('A3', 'Ngày cập nhật: ')
                ->setCellValue('C3', date('d/m/Y'))
                ->setCellValue('E3', 'TỔNG NAM')
                ->setCellValue('F3', '10')
                ->setCellValue('H3', 'TỔNG NỮ')
                ->setCellValue('I3', '100')
        ;
        $excel->getObjPHPExcel()->setActiveSheetIndex(0)->mergeCells("A3:B3");
        $excel->getObjPHPExcel()->setActiveSheetIndex(0)
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
        $borderStyleAll = $excel->getBorderStyleAll();
        $sheet = $excel->getObjPHPExcel()->getActiveSheet();
        $sum_nam = $sum_nu = 0;
        foreach ($rows as $row) {
            $excel->getObjPHPExcel()->getActiveSheet()->getRowDimension($i)->setRowHeight(50);
            if (html_entity_decode($row['gioi_tinh']) == 'Nam') {
                $sum_nam++;
            } else {
                $sum_nu++;
            }
            $excel->getObjPHPExcel()->setActiveSheetIndex(0)
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
                $excel->insertImage("B$i", $row['hinh_anh']);
            }


            $sheet->getStyle("E$i")->getAlignment()->setWrapText(true);
            $sheet->getStyle("M$i")->getAlignment()->setWrapText(true);
            $sheet->getStyle("N$i")->getAlignment()->setWrapText(true);
            $sheet->getStyle("O$i")->getAlignment()->setWrapText(true);
            $sheet->getStyle("P$i")->getAlignment()->setWrapText(true);
            $sheet->getStyle("L$i")->getAlignment()->setWrapText(true);

            $excel->setCellBorder("A$i:A$i", $borderStyleAll);
            $excel->setCellBorder("B$i:B$i", $borderStyleAll);
            $excel->setCellBorder("E$i:E$i", $borderStyleAll);
            $excel->setCellBorder("F$i:F$i", $borderStyleAll);
            $excel->setCellBorder("G$i:G$i", $borderStyleAll);
            $excel->setCellBorder("H$i:H$i", $borderStyleAll);
            $excel->setCellBorder("I$i:I$i", $borderStyleAll);
            $excel->setCellBorder("J$i:J$i", $borderStyleAll);
            $excel->setCellBorder("K$i:K$i", $borderStyleAll);
            $excel->setCellBorder("L$i:L$i", $borderStyleAll);
            $excel->setCellBorder("M$i:M$i", $borderStyleAll);
            $excel->setCellBorder("N$i:N$i", $borderStyleAll);
            $excel->setCellBorder("O$i:O$i", $borderStyleAll);
            $excel->setCellBorder("P$i:P$i", $borderStyleAll);

            $excel->setCellBorder("D$i:D$i", $border_style);
            $excel->setCellBorder("C$i:C$i", $border_style1);
            $i++;
        }

        $excel->getObjPHPExcel()->setActiveSheetIndex(0)
                ->setCellValue('F3', $sum_nam)
                ->setCellValue('I3', $sum_nu)
        ;
        $excel->export();

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
        
        $columns = array(
            'hinh_anh'=>'Hình ảnh',
            'ho_va_ten'=>'Họ và tên',
            'phap_danh'=>'Pháp Danh',
            'ten_facebook'=>'Tên hiển thị trên facebook',
            'facebook'=>'facebook',
            'dien_thoai'=>'Số điện thoại',
            'nam_sinh'=>'Năm sinh',
//            'gioi_tinh'=>'Giới tính',
            'nghe_nghiep'=>'Nghề nghiệp',
//            'email'=>'email',
//            'cmnd'=>'Số CMND',
//            'dia_chi_tam_tru'=>'Địa chỉ tạm trú',
//            'dia_chi_thuong_tru'=>'Địa chỉ thường trú',
//            'ngay_dk_tham_gia'=>'Ngày đăng ký tham gia',
//            'nguoi_gioi_thieu'=>'Người giới thiệu',
        );
        $this->view->columns = $columns;

        $this->view->items = $rows;
        $this->view->keyword = $keyword;
        $this->view->type = $type;
        $this->view->allowAdd = true;
    }

}
