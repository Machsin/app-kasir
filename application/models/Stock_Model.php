<?php
class Stock_model extends CI_Model
{

    public function tampil_stock_in()
    {
        $query = $this->db->select('tb_stock.*, tb_item.name as item_name, tb_item.barcode, tb_supplier.name as supplier_name')
            ->from('tb_stock')
            ->join('tb_item', 'tb_item.item_id = tb_stock.item_id')
            ->join('tb_supplier', 'tb_supplier.supplier_id = tb_stock.supplier_id', 'left')
            ->where('type', 'masuk')
            ->order_by('stock_id', 'DESC')
            ->get();
        return $query;
    }
    public function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE tb_item SET stock= stock +'$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }
    public function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE tb_item SET stock= stock -'$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }
    public function tampil_stock_out()
    {
        $query = $this->db->select('tb_stock.*, tb_item.name as item_name, tb_item.barcode, tb_supplier.name as supplier_name')
            ->from('tb_stock')
            ->join('tb_item', 'tb_item.item_id = tb_stock.item_id')
            ->join('tb_supplier', 'tb_supplier.supplier_id = tb_stock.supplier_id', 'left')
            ->where('type', 'keluar')
            ->order_by('stock_id', 'DESC')
            ->get();
        return $query;
    }
}
