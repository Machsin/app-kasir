<?php 
class Restore_Model extends CI_Model{

    function droptable(){
        $cek = $this->db->query('SHOW TABLES');

        if($cek->num_rows() > 0){
            $query= $this->db->query('DROP TABLE
            tb_cart, tb_cart_p, tb_categori, tb_customer, tb_item, tb_sale, tb_sale_detail, tb_setting, 
            tb_stock, tb_supplier, tb_unit, tb_user
            ');
            return $query;
        }else{
            return true;
        }
    }
}
?>