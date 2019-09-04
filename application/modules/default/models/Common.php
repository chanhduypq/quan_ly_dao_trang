<?php

class Default_Model_Common extends Core_Db_Table_Abstract {

    public function __construct() {
        parent::__construct();
    }

    public function uploadFile($file, $folderName) {
        if (isset($file) && isset($file['name']) && $file['name'] != '') {
            $fileName = Core_Common_File::getUniqidFileName($file['name']);
            $path = UPLOAD . "/public/$folderName/" . $fileName;
            move_uploaded_file($file['tmp_name'], $path);
            return $fileName;
        }
        return "";
    }

    public function removeOldFile($id, $folderName) {
        $item = $this->fetchRow("id = $id");
        if ($item['file_name'] != "") {
            $path = UPLOAD . "/public/$folderName/" . $item['file_name'];
            @unlink($path);
        }
    }

    public function uploadFileForAdd($file, $folderName) {
        return $this->uploadFile($file, $folderName);
    }

    public function uploadFileForEdit($id, $file, $folderName) {
        $this->removeOldFile($id, $folderName);
        return $this->uploadFile($file, $folderName);
    }

    public function getData($data, $forAdd = true) {
        $bind = array(
            'title' => Core_Common_String::ucWords($data['title']),
            'content' => $data['content'],
            'is_public' => $data['is_public'],
        );
        if ($forAdd === true) {
            if ($data['level'] != '0') {
                $bind['parent_id'] = $data['id'];
                $bind['number_children'] = '0';
            }
        }


        if ($this->_name == "bai_giang") {
            $bind['is_chu_de'] = $data['is_chu_de'];
            $bind['is_bai_giang'] = $data['is_bai_giang'];
            $bind['is_long_ton_kinh_phat'] = $data['is_long_ton_kinh_phat'];
            $bind['luu_y'] = $data['luu_y'];
            $bind['dia_diem_giang'] = $data['dia_diem_giang'];
            $bind['thoi_gian_giang'] = $data['thoi_gian_giang'];
        } else if ($this->_name == "chuyen_tien_than") {
            $bind['is_tuong_niem_cong_duc_Chu_Phat'] = $data['is_tuong_niem_cong_duc_Chu_Phat'];
            $bind['is_bon_than_thong_ton_tai_suot_kiep'] = $data['is_bon_than_thong_ton_tai_suot_kiep'];
            $bind['is_uy_luc_ai_duc'] = $data['is_uy_luc_ai_duc'];
            $bind['is_Phat_lam_than_rong'] = $data['is_Phat_lam_than_rong'];
            $bind['is_rung_dong_coi_troi_tam_thap_tam'] = $data['is_rung_dong_coi_troi_tam_thap_tam'];
            $bind['is_can_duoc_ke'] = $data['is_can_duoc_ke'];
            $bind['is_can_luu_y'] = $data['is_can_luu_y'];
        } else if ($this->_name == "dong_phap_su_phu") {
            $bind['is_tranh_nhan_qua'] = $data['is_tranh_nhan_qua'];
        }

        return $bind;
    }

    public function updateNumberOfChildrenOfParent($parentId) {
        $count = Core_Db_Table::getDefaultAdapter()->fetchOne("select count(*) as count from " . $this->_name . " where parent_id = $parentId");
        $this->update(array('number_children' => $count), "id = $parentId");
    }

}
