<?php 

class Admin_Form_User extends Core_Form 
{

    public function init() 
    {
        parent::init();
        $this->buildElementsAutoForFormByTableName('user');
        
        $this->removeElement("password");
        
        $this->removeElement("is_admin");
        
        $this->removeElement("danh_xung");
        $this->removeElement("is_download");
        $this->removeElement("is_upload");
        $this->removeElement("is_thongke");
        $danh_xung=new Core_Form_Element_Select('danh_xung');
        $danh_xung->setValue('Anh');
        $danh_xung->addMultiOptions(array('Anh'=>'Anh','Chị'=>'Chị'))->setLabel('Danh xưng:')->setValue('Anh')->setSeparator('')->setRequired();
        $this->addElement($danh_xung);
       
        $this->getElement('full_name')->setLabel('Họ và tên:');
        
        $this->getElement('phone')->setLabel('Phone:');
        
        $is_upload=new Core_Form_Element_Checkbox('is_upload');
        $is_upload->setValue('1')->setLabel('Cho phép nhập liệu');
        $this->addElement($is_upload);
        
        $is_download=new Core_Form_Element_Checkbox('is_download');
        $is_download->setValue('1')->setLabel('Cho phép download');
        $this->addElement($is_download);
        
        $is_thongke=new Core_Form_Element_Checkbox('is_thongke');
        $is_thongke->setValue('1')->setLabel('Cho phép xem thống kê');
        $this->addElement($is_thongke);
    }
    

}
