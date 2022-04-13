<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categori extends CI_Controller
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
        $data['categori'] = $this->Admin_Model->tampildata('tb_categori', 'categori_id');
        $this->load->view('template/header');
        $this->load->view('product/categori/categori_data', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $categori = new stdClass();
        $categori->categori_id = null;
        $categori->name = null;
        $data = array(
            'page' => 'tambah',
            'categori' => $categori
        );
        $this->load->view('template/header');
        $this->load->view('product/categori/categori_form', $data);
        $this->load->view('template/footer');
    }
    public function edit($id)
    {
        $query = $this->Admin_Model->formedit('tb_categori', 'categori_id', $id);
        if ($query->num_rows() > 0) {
            $categori = $query->row();
            $data = array(
                'page' => 'edit',
                'categori' => $categori
            );
            $this->load->view('template/header');
            $this->load->view('product/categori/categori_form', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('success', 'Data tidak ditemukan');
            redirect('categori');
        }
    }
    public function process()
    {
        $id = $this->input->post('categori_id');
        $updated = null;
        if (isset($_POST['edit'])) {
            $updated = date('Y-m-d H:i:s');
        }
        $data = array(
            'name' => $this->input->post('categori_name'),
            'updated' => $updated,
        );
        $this->form_validation->set_rules('categori_name', '', 'required', array('required' => 'Nama wajib diisi'));
        if ($this->form_validation->run() == FALSE) {
            if (isset($_POST['tambah'])) {
                $categori = new stdClass();
                $categori->categori_id = null;
                $categori->name = null;
                $data = array(
                    'page' => 'tambah',
                    'categori' => $categori
                );
                $this->load->view('template/header');
                $this->load->view('product/categori/categori_form', $data);
                $this->load->view('template/footer');
            } else {
                $query = $this->Admin_Model->formedit('tb_categori', 'categori_id', $id);
                if ($query->num_rows() > 0) {
                    $categori = $query->row();
                    $data = array(
                        'page' => 'edit',
                        'categori' => $categori
                    );
                    $this->load->view('template/header');
                    $this->load->view('product/categori/categori_form', $data);
                    $this->load->view('template/footer');
                } else {
                    $this->session->set_flashdata('success', 'Data tidak ditemukan');
                    redirect('categori');
                }
            } 
        } else {
            if (isset($_POST['tambah'])) {
                $this->Admin_Model->simpandata('tb_categori', $data);
            } else if (isset($_POST['edit'])) {
                $this->Admin_Model->editdata('tb_categori', 'categori_id', $id, $data);
            }
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('categori');
            }
        }
    }
    public function delete($id)
    {
        $this->Admin_Model->hapusdata('tb_categori', $id, 'categori_id');
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Data categori berhasil terhapus');
        }
        redirect('categori');
    }
}
