<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
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
        $data['supplier'] = $this->Admin_Model->tampildata('tb_supplier', 'supplier_id');
        $this->load->view('template/header');
        $this->load->view('supplier/supplier_data', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $supplier = new stdClass();
        $supplier->supplier_id = null;
        $supplier->name = null;
        $supplier->phone = null;
        $supplier->address = null;
        $supplier->description = null;
        $data = array(
            'page' => 'tambah',
            'supplier' => $supplier
        );
        $this->load->view('template/header');
        $this->load->view('supplier/supplier_form', $data);
        $this->load->view('template/footer');
    }
    public function edit($id)
    {
        $query = $this->Admin_Model->formedit('tb_supplier', 'supplier_id', $id);
        if ($query->num_rows() > 0) {
            $supplier = $query->row();
            $data = array(
                'page' => 'edit',
                'supplier' => $supplier
            );
            $this->load->view('template/header');
            $this->load->view('supplier/supplier_form', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('success', 'Data tidak ditemukan');
            redirect('supplier');
        }
    }
    public function process()
    {
        $id = $this->input->post('supplier_id');
        $updated = null;
        if (isset($_POST['edit'])) {
            $updated = date('Y-m-d H:i:s');
        }
        $data = array(
            'name' => $this->input->post('supplier_name'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'description' => $this->input->post('desc'),
            'updated' => $updated,
        );
        $this->form_validation->set_rules('supplier_name', '', 'required', array('required' => 'Nama wajib diisi'));
        $this->form_validation->set_rules('phone', '', 'required', array('required' => 'No. Telepon wajib diisi'));
        $this->form_validation->set_rules('address', '', 'required', array('required' => 'Alamat wajib diisi'));
        if ($this->form_validation->run() == FALSE) {
            if (isset($_POST['add'])) {
                $supplier = new stdClass();
                $supplier->supplier_id = null;
                $supplier->name = null;
                $supplier->phone = null;
                $supplier->address = null;
                $supplier->description = null;
                $data = array(
                    'page' => 'tambah',
                    'supplier' => $supplier
                );
                $this->load->view('template/header');
                $this->load->view('supplier/supplier_form', $data);
                $this->load->view('template/footer');
            } else {
                $query = $this->Admin_Model->formedit('tb_supplier', 'supplier_id', $id);
                if ($query->num_rows() > 0) {
                    $supplier = $query->row();
                    $data = array(
                        'page' => 'edit',
                        'supplier' => $supplier
                    );
                    $this->load->view('template/header');
                    $this->load->view('supplier/supplier_form', $data);
                    $this->load->view('template/footer');
                } else {
                    $this->session->set_flashdata('success', 'Data tidak ditemukan');
                    redirect('supplier');
                }
            }
        } else {
            if (isset($_POST['add'])) {
                $this->Admin_Model->simpandata('tb_supplier', $data);
            } else if (isset($_POST['edit'])) {
                $this->Admin_Model->editdata('tb_supplier', 'supplier_id', $id, $data);
            }
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('supplier');
            }
        }
    }
    public function delete($id)
    {
        $this->Admin_Model->hapusdata('tb_supplier', $id, 'supplier_id');
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Data Supplier berhasil terhapus');
        }
        redirect('supplier');
    }
}
