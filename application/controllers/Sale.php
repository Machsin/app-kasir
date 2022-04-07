<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sale extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['Admin_Model', 'Sale_Model', 'Item_Model']);
        if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
            redirect('login');
        }
    }
    public function index()
    {
        $data['customer'] = $this->Admin_Model->tampildata('tb_customer', 'customer_id');
        $data['item'] = $this->Item_Model->tampilitemsale();
        $data['cart'] = $this->Sale_Model->get_cart();
        $data['invoice'] = $this->Sale_Model->invoice_no();
        $this->load->view('template/header');
        $this->load->view('transaction/sale/sale_form', $data);
        $this->load->view('template/footer');
    }
    public function cart_data()
    { 
        $data['cart'] = $this->Sale_Model->get_cart();
        $this->load->view('transaction/sale/cart_data', $data);
    }
    public function process()
    {
        $post = $this->input->post(null, true);

        if (isset($_POST['add_cart'])) {

            $item_id = $this->input->post('item_id');
            $cek_cart = $this->Sale_Model->get_cart(['tb_cart.item_id' => $item_id]);
            if ($cek_cart->num_rows() > 0) {
                $this->Sale_Model->update_cart_qty($post);
            } else {
                $this->Sale_Model->add_cart($post);
            }

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
        if (isset($_POST['process_payment'])) {
            $sale_id = $this->Sale_Model->add_sale($post);
            $cart = $this->Sale_Model->get_cart()->result();
            $row = [];


            foreach ($cart as $c) {
                array_push($row, [
                    'sale_id' => $sale_id,
                    'item_id' => $c->item_id,
                    'price' => $c->cart_price,
                    'qty' => $c->qty,
                    'discount_item' => $c->discount_item,
                    'total' => $c->total
                ]);
            }

            $this->Sale_Model->add_sale_detail($row);
            $userid = $this->session->userdata('user_id');
            $this->Admin_Model->hapusdata('tb_cart', $userid, 'user_id');
            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true, "sale_id" => $sale_id);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }
    public function edit()
    {
        $id = $this->input->post('cart_id');
        $data = $this->Sale_Model->get($id)->row_array();
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public function update()
    {
        $post = $this->input->post();
        $this->Sale_Model->update_cart($post);
        $this->session->set_flashdata('pesan', 'Cart berhasil diupdate.');
        redirect('sale');
    }
    public function cart_del($id)
    {
        $this->Admin_Model->hapusdata('tb_cart', $id, 'cart_id');
        $this->session->set_flashdata('pesan', 'Cart berhasil di hapus!');
        redirect('sale');
    }
    public function reset()
    {
        if (isset($_POST['cancel_payment'])) {
            $userid = $this->session->userdata('user_id');
            $this->Admin_Model->hapusdata('tb_cart', $userid, 'user_id');
            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        } 
    }
    public function cetak($id)
    {
        $data['setting'] = $this->Admin_Model->formedit('tb_setting','setting_id','1')->row();
        $data['sale'] = $this->Sale_Model->get_sale($id)->row();
        $data['sale_detail'] = $this->Sale_Model->get_sale_detail($id)->result();
        $this->load->view('transaction/sale/print_struk', $data);
    }
}
