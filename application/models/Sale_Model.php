<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sale_Model extends CI_Model
{

    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no 
        FROM tb_sale 
        WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(),'%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int) $row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = '0001';
        }
        $setting = $this->db->get_where('tb_setting', array('setting_id', '1'))->row();
        $invoice = $setting->kode_struk . date('ymd') . $no;
        return $invoice;
    }
    public function get_cart($params = null)
    {
        $this->db->select('*,tb_item.barcode, tb_item.name as item_name, tb_cart.price as cart_price');
        $this->db->from('tb_cart');
        $this->db->join('tb_item', 'tb_cart.item_id=tb_item.item_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query;
    }
    public function update_cart_qty($post)
    {
        $sql = "UPDATE tb_cart SET price = '$post[price]', qty = qty + '$post[qty]', total = '$post[price]' * qty WHERE item_id = '$post[item_id]'";
        $this->db->query($sql);
    }
    public function add_cart($post)
    {
        $sql = "SELECT MAX(cart_id) AS cart_no FROM tb_cart";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $car_no = ((int) $row->cart_no) + 1;
        } else {
            $car_no = '1';
        }
        $params = [
            'cart_id' => $car_no,
            'item_id' => $post['item_id'],
            'price' => $post['price'],
            'discount_item' => 0,
            'qty' => $post['qty'],
            'total' => ($post['price'] * $post['qty']),
            'user_id' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_cart', $params);
    }
    public function get($id = null)
    {
        $this->db->select('*,tb_item.barcode, tb_item.name as item_name, tb_cart.price as cart_price, tb_cart.item_id as cart_item');
        $this->db->from('tb_cart');
        $this->db->join('tb_item', 'tb_cart.item_id=tb_item.item_id');
        if ($id != null) {
            $this->db->where('cart_id', $id);
        }
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get();
        return $query;
    }
    public function update_cart($post)
    {
        $data = [
            'price' => $post['item_price'],
            'discount_item' => $post['item_discount'],
            'qty' => $post['item_qty'],
            'total' => (($post['item_price'] * $post['item_qty']) - $post['item_discount']),
            'user_id' => $this->session->userdata('user_id')
        ];

        $this->db->where('cart_id', $post['cart_id']);
        $this->db->update('tb_cart', $data);
    }
    public function add_sale($post)
    {
        $data = [
            'invoice' => $this->invoice_no(),
            'customer_id' => $post['customer_id'] == '' ? '' : $post['customer_id'],
            'total_price' => $post['sub_total'],
            'discount' => $post['discount'],
            'final_price' => $post['grand_total'],
            'cash' => $post['cash'],
            'uang_kembalian' => $post['change'],
            'note' => $post['note'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('user_id')
        ];

        $this->db->insert('tb_sale', $data);
        return $this->db->insert_id();
    }
    public function add_sale_detail($data)
    {
        $this->db->insert_batch('tb_sale_detail', $data);
    }
    public function get_sale($id = null)
    {
        $this->db->select('*, tb_customer.name as customer_name, tb_user.name as user_name, tb_sale.created as sale_created');
        $this->db->from('tb_sale');
        $this->db->join('tb_user', 'tb_sale.user_id=tb_user.user_id');
        $this->db->join('tb_customer', 'tb_sale.customer_id=tb_customer.customer_id', 'left');
        if ($id != null) {
            $this->db->where('sale_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_sale_detail($sale_id = null)
    {
        $this->db->select('tb_sale_detail.*,tb_item.name as name,tb_unit.name as name_unit');
        $this->db->from('tb_sale_detail');
        $this->db->join('tb_item', 'tb_sale_detail.item_id=tb_item.item_id');
        $this->db->join('tb_unit', 'tb_item.unit_id=tb_unit.unit_id');
        if ($sale_id != null) {
            $this->db->where('tb_sale_detail.sale_id', $sale_id);
        }
        $query = $this->db->get();
        return $query;
    }
}
