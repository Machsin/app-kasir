<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['Admin_Model', 'Stock_Model', 'Item_Model']);
        if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
            redirect('login');
        }
    }

    public function stock_in()
    {
        $data['stockin'] = $this->Stock_Model->tampil_stock_in();
        $this->load->view('template/header');
        $this->load->view('transaction/stock_in/stock_in_data', $data);
        $this->load->view('template/footer');
    }
    public function stock_in_add()
    {
        $item = $this->Item_Model->tampildata()->result();
        $supplier = $this->Admin_Model->tampildata('tb_supplier', 'supplier_id')->result();
        $data = ['item' => $item, 'supplier' => $supplier];
        $this->load->view('template/header');
        $this->load->view('transaction/stock_in/stock_in_form', $data);
        $this->load->view('template/footer');
    }
    public function stock_process()
    {
        if (isset($_POST['in_add'])) {
            $datastock = array(
                'item_id' => $this->input->post('item_id'),
                'type' => 'masuk',
                'detail' => $this->input->post('detail'),
                'supplier_id' => $this->input->post('supplier') == '' ? null : $this->input->post('supplier'),
                'qty' => $this->input->post('qty'),
                'date' => $this->input->post('date'),
                'user_id' => $this->session->userdata('user_id'),
            );
            $stock = array(
                'item_id' => $this->input->post('item_id'),
                'qty' => $this->input->post('qty'),
            );
            $this->Admin_Model->simpandata('tb_stock', $datastock);
            $this->Stock_Model->update_stock_in($stock);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Stock-in Berhasil disimpan');
            }
            redirect('stock/in');
        } else {
            $datastock = array(
                'item_id' => $this->input->post('item_id'),
                'type' => 'keluar',
                'detail' => $this->input->post('detail'),
                'qty' => $this->input->post('qty'),
                'date' => $this->input->post('date'),
                'user_id' => $this->session->userdata('user_id'),
            );
            $stock = array(
                'item_id' => $this->input->post('item_id'),
                'qty' => $this->input->post('qty'),
            );
            $this->Admin_Model->simpandata('tb_stock', $datastock);
            $this->Stock_Model->update_stock_out($stock);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data Stock-out Berhasil disimpan');
            }
            redirect('stock/out');
        }
    }
    public function stock_in_del()
    {
        $stock_id = $this->uri->segment('4');
        $item_id = $this->uri->segment('5');
        $qty = $this->Admin_Model->formedit('tb_stock', 'stock_id', $stock_id)->row()->qty;
        $data = ['qty' => $qty, 'item_id' => $item_id];

        $this->Stock_Model->update_stock_out($data);
        $this->Admin_Model->hapusdata('tb_stock', $stock_id, 'stock_id');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success','Data Stock-In berhasil dihapus');
        }
        redirect('stock/in');
    }
    public function stock_out()
    {
        $data['stockout'] = $this->Stock_Model->tampil_stock_out();
        $this->load->view('template/header');
        $this->load->view('transaction/stock_out/stock_out_data', $data);
        $this->load->view('template/footer');
    }
    public function stock_out_add()
    {
        $item = $this->Item_Model->tampildata()->result();
        $supplier = $this->Admin_Model->tampildata('tb_supplier', 'supplier_id')->result();
        $data = ['item' => $item, 'supplier' => $supplier];
        $this->load->view('template/header');
        $this->load->view('transaction/stock_out/stock_out_form', $data);
        $this->load->view('template/footer');
    }
    public function stock_out_del()
    {
        $stock_id = $this->uri->segment('4');
        $item_id = $this->uri->segment('5');
        $qty = $this->Admin_Model->formedit('tb_stock', 'stock_id', $stock_id)->row()->qty;
        $data = ['qty' => $qty, 'item_id' => $item_id];

        $this->Stock_Model->update_stock_in($data);
        $this->Admin_Model->hapusdata('tb_stock', $stock_id, 'stock_id');
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success','Data Stock-out berhasil dihapus');
        }
        redirect('stock/out');
    }
}
