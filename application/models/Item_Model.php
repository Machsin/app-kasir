<?php
class Item_model extends CI_Model
{

    public function tampildata()
    {
        $query = $this->db->select('tb_item.*, tb_categori.name as categori_name, tb_unit.name as unit_name')
            ->from('tb_item')
            ->join('tb_categori', 'tb_categori.categori_id = tb_item.categori_id', 'left')
            ->join('tb_unit', 'tb_unit.unit_id = tb_item.unit_id', 'left')
            ->order_by('item_id', 'DESC')
            ->get();
        return $query;
    }
    public function tampilitemsale()
    {
        $query = $this->db->select('tb_item.*, tb_categori.name as categori_name, tb_unit.name as unit_name')
            ->from('tb_item')
            ->join('tb_categori', 'tb_categori.categori_id = tb_item.categori_id', 'left')
            ->join('tb_unit', 'tb_unit.unit_id = tb_item.unit_id', 'left')
            ->order_by('item_id', 'DESC')
            ->where('tb_item.unit_id NOT IN (3)')
            ->get();
        return $query;
    }
    public function barcode_no()
    {
        $sql = "SELECT MAX(MID(barcode,2,4)) AS barcode_no 
        FROM tb_item";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int) $row->barcode_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = '0001';
        }
        $kode = $this->db->get_where('tb_setting', array('setting_id', '1'))->row()->kode_barcode;
        $barcode = $kode . $no;
        return $barcode;
    }
    public function tampil()
    {
        $query = $this->db->select('tb_item.*, tb_categori.name as categori_name, tb_unit.name as unit_name')
            ->from('tb_item')
            ->join('tb_categori', 'tb_categori.categori_id = tb_item.categori_id', 'left')
            ->join('tb_unit', 'tb_unit.unit_id = tb_item.unit_id', 'left')
            ->where('tb_item.unit_id=3')
            ->get();
        return $query;
    }
}
