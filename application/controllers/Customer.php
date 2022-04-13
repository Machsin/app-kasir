<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Model');
        if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
            redirect('login');
        }
    }
    public function index()
    {
        $data['customer'] = $this->Admin_Model->tampildata('tb_customer', 'customer_id');
        $this->load->view('template/header');
        $this->load->view('customer/customer_data', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $customer = new stdClass();
        $customer->customer_id = null;
        $customer->name = null;
        $customer->gender = null;
        $customer->phone = null;
        $customer->address = null;
        $customer->description = null;
        $data = array(
            'page' => 'tambah',
            'title' => 'Tambah Data Pelanggan',
            'customer' => $customer
        );
        $this->load->view('template/header');
        $this->load->view('customer/customer_form', $data);
        $this->load->view('template/footer');
    }
    public function edit($id)
    {
        $query = $this->Admin_Model->formedit('tb_customer', 'customer_id', $id);
        if ($query->num_rows() > 0) {
            $customer = $query->row();
            $data = array(
                'page' => 'edit',
                'title' => 'Edit Data Pelanggan',
                'customer' => $customer
            );
            $this->load->view('template/header');
            $this->load->view('customer/customer_form', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('success', 'Data tidak ditemukan');
            redirect('customer');
        }
    }
    public function process()
    {
        $id = $this->input->post('customer_id');
        $updated = null;
        if (isset($_POST['edit'])) {
            $updated = date('Y-m-d H:i:s');
        }
        $data = array(
            'name' => $this->input->post('customer_name'),
            'gender' => $this->input->post('gender'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'updated' => $updated,
        );
        $this->form_validation->set_rules('customer_name', '', 'required', array('required' => 'Nama wajib diisi'));
        $this->form_validation->set_rules('gender', '', 'required', array('required' => 'Gender wajib dipilih'));
        $this->form_validation->set_rules('phone', '', 'required', array('required' => 'Phone wajib diisi'));
        $this->form_validation->set_rules('address', '', 'required', array('required' => 'Address wajib diisi'));
        if ($this->form_validation->run() == FALSE) {
            if (isset($_POST['tambah'])) {
                $customer = new stdClass();
                $customer->customer_id = null;
                $customer->name = null;
                $customer->gender = null;
                $customer->phone = null;
                $customer->address = null;
                $customer->description = null;
                $data = array(
                    'page' => 'tambah',
                    'title' => 'Tambah Data Pelanggan',
                    'customer' => $customer
                );
                $this->load->view('template/header');
                $this->load->view('customer/customer_form', $data);
                $this->load->view('template/footer');
            } else {
                $query = $this->Admin_Model->formedit('tb_customer', 'customer_id', $id);
                if ($query->num_rows() > 0) {
                    $customer = $query->row();
                    $data = array(
                        'page' => 'edit',
                        'title' => 'Edit Data Pelanggan',
                        'customer' => $customer
                    );
                    $this->load->view('template/header');
                    $this->load->view('customer/customer_form', $data);
                    $this->load->view('template/footer');
                } else {
                    $this->session->set_flashdata('success', 'Data tidak ditemukan');
                    redirect('customer');
                }
            }
        } else {
            if (isset($_POST['tambah'])) {
                $this->Admin_Model->simpandata('tb_customer', $data);
            } else if (isset($_POST['edit'])) {
                $this->Admin_Model->editdata('tb_customer', 'customer_id', $id, $data);
            }
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('customer');
            }
        }
    }
    public function delete($id)
    {
        $this->Admin_Model->hapusdata('tb_customer', $id, 'customer_id');
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Data customer berhasil terhapus');
        }
        redirect('customer');
    }
}
