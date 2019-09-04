<?php 

class Admin_Form_Thanhvien extends Core_Form 
{

    public function init() 
    {
        parent::init();
        $this->buildElementsAutoForFormByTableName('thanh_vien');
        
        
        $this->getElement('ho')->setLabel('Họ và lót: ');
        $this->getElement('ten')->setLabel('Tên: ');
        $this->getElement('phap_danh')->setLabel('Pháp danh: ');
        $this->getElement('nam_sinh')->setLabel('Năm sinh: ');
        $this->getElement('nghe_nghiep')->setLabel('Nghề nghiệp: ');
        $this->getElement('email')->setLabel('email: ');
        $this->getElement('facebook')->setLabel('facebook: ');
        $this->getElement('cmnd')->setLabel('Số CMND: ');
        $this->getElement('dien_thoai')->setLabel('Số điện thoại: ');
        $this->getElement('dia_chi_tam_tru')->setLabel('Địa chỉ tạm trú: ');
        $this->getElement('dia_chi_thuong_tru')->setLabel('Địa chỉ thường trú: ');
        $this->getElement('ngay_dk_tham_gia')->setLabel('Ngày ĐK tham gia: ');
        $this->getElement('nguoi_gioi_thieu')->setLabel('Người giới thiệu: ');
        
        $this->removeElement("gioi_tinh");
        $this->removeElement("password");
        $gioi_tinh=new Core_Form_Element_Select('gioi_tinh');
        $gioi_tinh->setLabel('Giới tính: ');
        $gioi_tinh->addMultiOptions(array('Nam'=>'Nam','Nữ'=>'Nữ'))->setValue('Nam')->setSeparator(' ');
        $this->addElement($gioi_tinh);
        
        $this->removeElement("hinh_anh");
        $hinh_anh=new Core_Form_Element_File('hinh_anh');
        $hinh_anh->setLabel('Hình ảnh: ');
        $hinh_anh->setDestination('avatar');
        $this->addElement($hinh_anh);
        
    }
    

}
