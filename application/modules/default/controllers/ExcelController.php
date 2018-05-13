<?php

class ExcelController extends Core_Controller_Action {
    public $has_old = false;

    public function init() {
        parent::init();
        $this->view->headTitle('Nhập liệu', true);
    }

    public function indexAction() {
        $this->view->message = $this->getMessage();        
    }
    
    public function saveAction() {
        $error = '';
        
        if (!isset($_FILES['excel']) || !isset($_FILES['excel']['name']) || $_FILES['excel']['name'] == '') {
            $error .= 'Vui lòng chọn file excel.<br>';
        }
        
        if ($error != '') {
            Core::message()->addSuccess($error);
            $this->_helper->redirector('index', 'excel', 'default');
            exit;
        }

        $this->delete();
        
        $this->add();

        Core::message()->addSuccess('Lưu thành công');
        $this->_helper->redirector('index', 'excel', 'default');
    }

    private function delete() {
        Core_Db_Table::getDefaultAdapter()->delete("thanh_vien");
    }

    private function add() {
        $path = UPLOAD . "/public/uploads/";
        @mkdir($path);
        $item = $_FILES['excel']['name'];
        $extension = @explode(".", $item);
        $extension = $extension[count($extension) - 1];
//        if (strtolower($extension) != 'xls') {
//            Core::message()->addSuccess('Vui lòng upload file excel theo định dạng 2003');
//            $this->_helper->redirector('index', 'excel', 'default');
//            exit;
//        }
        $item = 'excel.' . $extension;
        move_uploaded_file($_FILES['excel']['tmp_name'], $path . "/" . $item);
        if ($this->importExcel('uploads/' . $item) == FALSE) {
            Core::message()->addSuccess('Vui lòng upload file excel theo định dạng 2003');
            $this->_helper->redirector('index', 'excel', 'default');
            exit;
        }

    }

    

    private function importExcel($file_name) {

        require_once 'PHPExcel/Documentation/Examples/Reader/reader.php';

        $objPHPExcel = new reader();
        $data = $objPHPExcel->read($file_name);
        $this->saveThanhVien($data);
        
        return true;
    }

    private function saveThanhVien($data) {

        $mapper = new Default_Model_Thanhvien();

        foreach ($data as $key=>$value){
            $ho_ten = $value['A'];
            $phap_danh=$value['B'];
            $que_quan=$value['C'];
            $nam_sinh=$value['D'];
            $ngay_sinh=$value['E'];
            list($d,$m,$y)= explode("/", $ngay_sinh);
            $ngay_sinh="$y-$m-$d";
            $thong_tin_khac=$value['F'];
            
            if($ho_ten!='Họ và tên'){
                $mapper->insert(array(
                    'ho_ten' => $ho_ten,
                    'phap_danh' => $phap_danh,
                    'que_quan' => $que_quan,
                    'nam_sinh' => $nam_sinh,
                    'ngay_sinh' => $ngay_sinh,
                    'thong_tin_khac' => $thong_tin_khac,
                ));
            }
            
        }
        
    }

}
