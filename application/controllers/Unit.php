<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
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
        $data['unit'] = $this->Admin_Model->tampildata('tb_unit', 'unit_id');
        $this->load->view('template/header');
        $this->load->view('product/unit/unit_data', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $unit = new stdClass();
        $unit->unit_id = null;
        $unit->name = null;
        $data = array(
            'page' => 'tambah',
            'unit' => $unit
        );
        $this->load->view('template/header');
        $this->load->view('product/unit/unit_form', $data);
        $this->load->view('template/footer');
    }
    public function edit($id)
    {
        $query = $this->Admin_Model->formedit('tb_unit', 'unit_id', $id);
        if ($query->num_rows() > 0) {
            $unit = $query->row();
            $data = array(
                'page' => 'edit',
                'unit' => $unit
            );
            $this->load->view('template/header');
            $this->load->view('product/unit/unit_form', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('success', 'Data tidak ditemukan');
            redirect('unit');
        }
    }
    public function process()
    {
        $id = $this->input->post('unit_id');
        $updated = null;
        if (isset($_POST['edit'])) {
            $updated = date('Y-m-d H:i:s');
        }
        $data = array(
            'name' => $this->input->post('unit_name'),
            'updated' => $updated,
        );
        $this->form_validation->set_rules('unit_name', '', 'required', array('required' => 'Nama wajib diisi'));
        if ($this->form_validation->run() == FALSE) {
            if (isset($_POST['add'])) {
                $unit = new stdClass();
                $unit->unit_id = null;
                $unit->name = null;
                $data = array(
                    'page' => 'tambah',
                    'unit' => $unit
                );
                $this->load->view('template/header');
                $this->load->view('product/unit/unit_form', $data);
                $this->load->view('template/footer');
            } else {
                $query = $this->Admin_Model->formedit('tb_unit', 'unit_id', $id);
                if ($query->num_rows() > 0) {
                    $unit = $query->row();
                    $data = array(
                        'page' => 'edit',
                        'unit' => $unit
                    );
                    $this->load->view('template/header');
                    $this->load->view('product/unit/unit_form', $data);
                    $this->load->view('template/footer');
                } else {
                    $this->session->set_flashdata('success', 'Data tidak ditemukan');
                    redirect('unit');
                }
            }
        } else {
            if (isset($_POST['add'])) {
                $this->Admin_Model->simpandata('tb_unit', $data);
            } else if (isset($_POST['edit'])) {
                $this->Admin_Model->editdata('tb_unit', 'unit_id', $id, $data);
            }
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('unit');
            }
        }
    }
    public function delete($id)
    {
        $this->Admin_Model->hapusdata('tb_unit', $id, 'unit_id');
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Data unit berhasil terhapus');
        }
        redirect('unit');
    }
}
