<?php
class Report_model extends CI_Model
{

    public function tampildatastock()
    {
        $query = $this->db->select('tb_stock.*, tb_user.name as user_name, tb_supplier.name as supplier_name, tb_item.name as item_name, tb_item.price, (tb_item.price*tb_stock.qty) as total')
            ->from('tb_stock')
            ->join('tb_user', 'tb_user.user_id = tb_stock.user_id')
            ->join('tb_supplier', 'tb_supplier.supplier_id = tb_stock.supplier_id', 'left')
            ->join('tb_item', 'tb_item.item_id = tb_stock.item_id')
            ->order_by('stock_id', 'DESC')
            ->get();
        return $query;
    }
    public function tampildatastocks($where)
    {
        $query = $this->db->select('tb_stock.*, tb_user.name as user_name, tb_supplier.name as supplier_name, tb_item.name as item_name, tb_item.price, (tb_item.price*tb_stock.qty) as total')
            ->from('tb_stock')
            ->join('tb_user', 'tb_user.user_id = tb_stock.user_id')
            ->join('tb_supplier', 'tb_supplier.supplier_id = tb_stock.supplier_id', 'left')
            ->join('tb_item', 'tb_item.item_id = tb_stock.item_id')
            ->where($where)
            ->get();
        return $query;
    }
    public function tampildatasale($where = null)
    {
        $query = $this->db->select('tb_sale.*,tb_customer.name as customer_name, tb_user.name as user_name')
            ->from('tb_sale')
            ->join('tb_customer', 'tb_customer.customer_id=tb_sale.customer_id', 'left')
            ->join('tb_user', 'tb_user.user_id = tb_sale.user_id');
        if ($where != null) {
            $query->where($where);
        }
        return $query->get();
    }
    public function tampilproduct($id)
    {
        $query = $this->db->select('tb_sale_detail.*,tb_item.name as name_item')
            ->from('tb_sale_detail')
            ->join('tb_item', 'tb_item.item_id=tb_sale_detail.item_id')
            ->where('tb_sale_detail.sale_id', $id)
            ->get();
        return $query;
    }
}
