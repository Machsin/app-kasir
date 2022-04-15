<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backup extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['Admin_Model', 'Restore_Model']);
        if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
            redirect('login');
        }
    }
    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('backup/backup_data');
        $this->load->view('template/footer');
    }
    public function backup()
    {
        date_default_timezone_set("Asia/Jakarta"); // set waktu sesuai lokasi

        $this->load->dbutil();
        $pref = [
            'format' => 'zip',
            'filename' => 'db_kasir.sql'
        ];

        $backup     = $this->dbutil->backup($pref);
        $db_name    = 'backup_database__' . date("d-m-Y__H-i-s") . '.zip'; // nama backup dalam bentuk zip
        $save       = "./db/" . $db_name; //folder tempat database disimpan

        $this->load->helper('file'); // load helper file
        write_file($save, $backup);

        $this->load->helper("download"); // load helper download
        force_download($db_name, $backup);
    }
    public function restore()
    {
        $this->Restore_Model->droptable();
        //upload
        $config['upload_path']    = './db/';
        $config['allowed_types'] = '*';
        $config['file_name']    = 'db-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);
        if ($_FILES['db']['name'] != null) {
            if ($this->upload->do_upload('db')) {
                // Restore
                $nama_file = $this->upload->data('file_name');
                $direktori = './db/' . $nama_file;

                $isi_file = file_get_contents($direktori);
                $string_query = rtrim($isi_file, "\n;");
                $array_query = explode(";", $string_query);

                foreach ($array_query as $query) {
                    $this->db->query($query);
                    // print_r(nl2br($query));
                }
                
                unlink($direktori);
                $this->session->set_flashdata('success', 'Database Berhasil di Restore');
                // redirect('backup');
            } else {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('backup');
            }
        } else {
            $this->session->set_flashdata('error', 'Database Gagal di Restore');
            redirect('backup');
        }
    }
}
