<?php

class ChuyentienthanController extends Core_Controller_Action {

    private $keyword = "";
    private $type = "";
    
    public function init() {
        parent::init();
        $this->view->headTitle('Chuyện tiền thân', true);
        $this->keyword = $this->_getParam('keyword', '');
        $this->type = $this->_getParam('type', 'title');
    }

    public function indexAction() {
        
        $where = $this->getWhere();
        $sql = "select * from chuyen_tien_than $where order by title COLLATE utf8_unicode_ci;";
        $rows = Core_Db_Table::getDefaultAdapter()->fetchAll($sql);
        $is_tuong_niem_cong_duc_Chu_Phat 
                = $is_bon_than_thong_ton_tai_suot_kiep 
                = $is_uy_luc_ai_duc
                = $is_Phat_lam_than_rong
                = $is_rung_dong_coi_troi_tam_thap_tam
                = $is_can_duoc_ke
                = $is_can_luu_y = 0;
        foreach ($rows as $row){
            if ($row['is_tuong_niem_cong_duc_Chu_Phat']=='1'){
                $is_tuong_niem_cong_duc_Chu_Phat++;
            }
            else if ($row['is_bon_than_thong_ton_tai_suot_kiep']=='1'){
                $is_bon_than_thong_ton_tai_suot_kiep++;
            }
            else if ($row['is_uy_luc_ai_duc']=='1'){
                $is_uy_luc_ai_duc++;
            }
            else if ($row['is_Phat_lam_than_rong']=='1'){
                $is_Phat_lam_than_rong++;
            }
            else if ($row['is_rung_dong_coi_troi_tam_thap_tam']=='1'){
                $is_rung_dong_coi_troi_tam_thap_tam++;
            }
            else if ($row['is_can_duoc_ke']=='1'){
                $is_can_duoc_ke++;
            }
            else if ($row['is_can_luu_y']=='1'){
                $is_can_luu_y++;
            }
            
        }
        
        $columns = array(
            'title'=>'Tựa đề',
            'content'=>'Nội dung',
            'is_tuong_niem_cong_duc_Chu_Phat'=>'Tưởng niệm công đức Chư Phật',
            'is_bon_than_thong_ton_tai_suot_kiep'=>'Bốn thần thông tồn tại suốt kiếp',
            'is_uy_luc_ai_duc'=>'Uy lực của ái dục',
            'is_Phat_lam_than_rong'=>'Phật làm thân rồng',
            'is_rung_dong_coi_troi_tam_thap_tam'=>'Rúng động Cõi Trời Tam Thập Tam',
            'is_can_duoc_ke'=>'Cần được kể',
            'is_can_luu_y'=>'Cần được lưu ý',
        );
        $this->view->columns = $columns;

        $this->view->items = $rows;
        $this->view->keyword = $this->keyword;
        $this->view->type = $this->type;
        $this->view->is_tuong_niem_cong_duc_Chu_Phat = $is_tuong_niem_cong_duc_Chu_Phat;
        $this->view->is_bon_than_thong_ton_tai_suot_kiep = $is_bon_than_thong_ton_tai_suot_kiep;
        $this->view->is_uy_luc_ai_duc = $is_uy_luc_ai_duc;
        $this->view->is_Phat_lam_than_rong = $is_Phat_lam_than_rong;
        $this->view->is_rung_dong_coi_troi_tam_thap_tam = $is_rung_dong_coi_troi_tam_thap_tam;
        $this->view->is_can_duoc_ke = $is_can_duoc_ke;
        $this->view->is_can_luu_y = $is_can_luu_y;
    }
    
    private function getWhere() {
        if ($this->keyword != '') {
            if ($this->type == 'all'){
                return "where content <> '' and (title like '%" . $this->keyword . "%' or content like '%" . $this->keyword . "%')";
            }
            else{
                return "where content <> '' and " . $this->type . " like '%" . $this->keyword . "%'";
            }
            
        } else {
            return "where content <> ''";
        }
    }

}
