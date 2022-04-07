<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model(['Admin_Model','Dashboard_Model']);
		if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
			redirect('login');
		}
	}
    public function index()
	{
		$data['item'] = $this->db->get('tb_item')->num_rows();
		$data['supplier'] = $this->db->get('tb_supplier')->num_rows();
		$data['customer'] = $this->db->get('tb_customer')->num_rows();
		$data['user'] = $this->db->get('tb_user')->num_rows();

		$bulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];
		for ($i = 0; $i < sizeof($bulan); $i++) {
			if ($i < 10) {
				$b = '0' . ($i + 1);
			}
			$b = $i+1;
			$data[$bulan[$i]] = $this->Dashboard_Model->tampilsale($b);
		}
		for ($i = 1; $i <= 31; $i++) {
			if ($i < 10) {
				$b = '0' . $i;
			}
			$b = $i;
			$data['hari' . $i] = $this->Dashboard_Model->tampilsalehari($b);
		}
		$this->load->view('template/header');
		$this->load->view('dashboard',$data);
		$this->load->view('template/footer');
	}
}