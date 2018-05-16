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
        $path    = 'avatar';
        $files = scandir($path);
        foreach ($files as $file){
            if ($file != "." && $file != "..") {

                @unlink("avatar/$file");
            }
        }
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
        $this->saveThanhVien($data,$file_name);
        
        return true;
        
        
    }
    
    private function getImage($file_name,$index){
        include_once 'PHPExcel/IOFactory.php';
        $objPHPExcel = PHPExcel_IOFactory::load($file_name);
        foreach ($objPHPExcel->getActiveSheet()->getDrawingCollection() as $drawing) {
            
            $cellID = $drawing->getCoordinates();
            if($cellID == "B$index"){
                if ($drawing instanceof PHPExcel_Worksheet_MemoryDrawing) {
                    ob_start();
                    call_user_func(
                            $drawing->getRenderingFunction(), $drawing->getImageResource()
                    );

                    $imageContents = ob_get_contents();
                    ob_end_clean();
                    $extension = 'png';
                } else {
                    $zipReader = fopen($drawing->getPath(), 'r');
                    $imageContents = '';

                    while (!feof($zipReader)) {
                        $imageContents .= fread($zipReader, 1024);
                    }
                    fclose($zipReader);
                    $extension = $drawing->getExtension();
                }
                $myFileName = md5(uniqid(rand(), true)) . '.' . $extension;
                file_put_contents("avatar/".$myFileName, $imageContents);
                return $myFileName;
            }
        }
        
        return '';
    }

    private function saveThanhVien($data,$file_name) {
        $mapper = new Default_Model_Thanhvien();

        $i=1;
        foreach ($data as $key=>$value){
            if($i<6){
                $i++;
                continue;
            }
            
            $hinh_anh=$this->getImage($file_name, $i);
//            $hinh_anh = ($i-1).".png";
            
            $ho=$value['C'];
            $ten=$value['D'];
            $phap_danh=$value['E'];
            $nam_sinh=$value['F'];
            $gioi_tinh=$value['G'];
            $nghe_nghiep=$value['H'];
            $email=$value['I'];
            $facebook=$value['J'];
            $cmnd=$value['K'];
            $dien_thoai=$value['L'];
            $dia_chi_tam_tru=$value['M'];
            $dia_chi_thuong_tru=$value['N'];
            $ngay_dk_tham_gia=$value['O'];
            $nguoi_gioi_thieu=$value['P'];
            
            $mapper->insert(array(
                    'hinh_anh'=>$hinh_anh,
                    'ho' => $ho,
                    'ten' => $ten,
                    'phap_danh' => $phap_danh,
                    'nam_sinh' => $nam_sinh,
                    'gioi_tinh' => $gioi_tinh,
                    'nghe_nghiep' => $nghe_nghiep,
                    'email' => $email,
                    'facebook' => $facebook,
                    'cmnd' => $cmnd,
                    'dien_thoai' => $dien_thoai,
                    'dia_chi_tam_tru' => $dia_chi_tam_tru,
                    'dia_chi_thuong_tru' => $dia_chi_thuong_tru,
                    'ngay_dk_tham_gia' => $ngay_dk_tham_gia,
                    'nguoi_gioi_thieu' => $nguoi_gioi_thieu,
                ));
            
            $i++;
            
        }
        
    }

}
