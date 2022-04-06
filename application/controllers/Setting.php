<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['Admin_Model','Sale_Model']);
        if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
            redirect('login');
        }
    }
    public function index()
    {
        $data['setting'] = $this->Admin_Model->formedit('tb_setting', 'setting_id', '1')->row();
        $data['invoice'] = $this->Sale_Model->invoice_no();
        $this->load->view('template/header');
        $this->load->view('setting', $data);
        $this->load->view('template/footer');
    }
    public function process()
    {
        $id = $this->input->post('setting_id');
        $data = array(
            'nama_toko' => $this->input->post('setting_name'),
            'pemilik_toko' => $this->input->post('pemilik'),
            'phone' => $this->input->post('telp'),
            'address' => $this->input->post('alamat'),
            'kode_struk' => $this->input->post('struk'),
            'kode_barcode' => $this->input->post('barcode'),
        );
        $this->Admin_Model->editdata('tb_setting', 'setting_id', $id, $data);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil disimpan');
            redirect('setting');
        }
    }
}
