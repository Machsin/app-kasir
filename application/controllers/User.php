<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data['user'] = $this->Admin_Model->tampildata('tb_user', 'user_id');
        $this->load->view('template/header');
        $this->load->view('user/user_data', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $user = new stdClass();
        $user->user_id = null;
        $user->name = null;
        $user->username = null;
        $user->password = null;
        $user->address = null;
        $user->level = null;
        $data = array(
            'page' => 'tambah',
            'title' =>'Tambah Data Pengguna',
            'user' => $user
        );
        $this->load->view('template/header');
        $this->load->view('user/user_form', $data);
        $this->load->view('template/footer');
    }
    public function edit($id)
    {
        $query = $this->Admin_Model->formedit('tb_user', 'user_id', $id);
        if ($query->num_rows() > 0) {
            $user = $query->row();
            $data = array(
                'page' => 'edit',
                'title' =>'Edit Data Pengguna',
                'user' => $user
            );
            $this->load->view('template/header');
            $this->load->view('user/user_form', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('success', 'Data tidak ditemukan');
            redirect('user');
        }
    }
    public function process()
    {
        $id = $this->input->post('user_id');
        $data = array(
            'name' => $this->input->post('fullname'),
            'username' => $this->input->post('username'),
            'password' => sha1($this->input->post('username')),
            'address' => $this->input->post('address'),
            'level' => $this->input->post('level'),
        );
        $this->form_validation->set_rules('fullname', '', 'required', array('required' => 'Nama wajib diisi'));
        $this->form_validation->set_rules('username', '', 'required|min_length[5]', array('required' => 'Username wajib diisi', 'min_length' => 'Username minimal 5 karakter'));
        if (isset($_POST['tambah']) || $this->input->post('password') != '') {
            $this->form_validation->set_rules('password', '', 'required|min_length[5]', array('required' => 'Password wajib diisi', 'min_length' => 'Password minimal 5 karakter'));
            $this->form_validation->set_rules('passwordconf', '', 'required|matches[password]', array('required' => 'Konfirmasi wajib diisi', 'matches' => 'Password dan Konfirmasi tidak sama'));
        }
        $this->form_validation->set_rules('level', '', 'required', array('required' => 'Level wajib pilih'));
        if ($this->form_validation->run() == FALSE) {
            if (isset($_POST['tambah'])) {
                $user = new stdClass();
                $user->user_id = null;
                $user->name = null;
                $user->username = null;
                $user->password = null;
                $user->address = null;
                $user->level = null;
                $data = array(
                    'page' => 'tambah',
                    'title' =>'Tambah Data Pengguna',
                    'user' => $user
                );
                $this->load->view('template/header');
                $this->load->view('user/user_form', $data);
                $this->load->view('template/footer');
            } else {
                $query = $this->Admin_Model->formedit('tb_user', 'user_id', $id);
                if ($query->num_rows() > 0) {
                    $user = $query->row();
                    $data = array(
                        'page' => 'edit',
                        'title' =>'Edit Data Pengguna',
                        'user' => $user
                    );
                    $this->load->view('template/header');
                    $this->load->view('user/user_form', $data);
                    $this->load->view('template/footer');
                } else {
                    $this->session->set_flashdata('success', 'Data tidak ditemukan');
                    redirect('user');
                }
            }
        } else {
            if (isset($_POST['tambah'])) {
                $this->Admin_Model->simpandata('tb_user', $data);
            } else if (isset($_POST['edit'])) {
                $this->Admin_Model->editdata('tb_user', 'user_id', $id, $data);
            }
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
                redirect('user');
            }else{
                $this->session->set_flashdata('error', 'Data gagal disimpan');
                redirect('user');
            }
        }
    }
    public function delete($id)
    {
        $this->Admin_Model->hapusdata('tb_user', $id, 'user_id');
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('user');
    }
}
