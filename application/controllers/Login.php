<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(['Login_Model','Admin_Model']);
    }

    public function index()
    {
        $data['pesan'] = "";
        $data['setting'] = $this->Admin_Model->formedit('tb_setting', 'setting_id', '1')->row();
        $this->load->view('login', $data);
    }
    public function proses_login()
    {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
 
        $ceklogin = $this->Login_Model->akses_login($user, $pass);
        if ($ceklogin) {
            foreach ($ceklogin as $r)
                $this->session->set_userdata('user_id', $r->user_id);
            $this->session->set_userdata('username', $r->username);
            $this->session->set_userdata('password', $r->password);
            $this->session->set_userdata('name', $r->name);
            $this->session->set_userdata('address', $r->address);
            $this->session->set_userdata('level', $r->level);
            redirect('dashboard');
        } else {
            $data['setting'] = $this->Admin_Model->formedit('tb_setting', 'setting_id', '1')->row();
            $this->session->set_flashdata('error', 'Username atau Password salah');
            $this->load->view('login', $data);
        }
    }
    public function keluar()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
