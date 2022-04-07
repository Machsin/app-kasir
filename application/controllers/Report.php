<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['Admin_Model', 'Report_Model']);
        if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
            redirect('login');
        }
    }
    public function report_stock()
    {
        $bln = date('m');
        $thn = date('Y');

        $awal = $thn . '-' . $bln . '-01';
        $akhir = $thn . '-' . $bln . '-31';
        $data['setting'] = $this->Admin_Model->formedit('tb_setting','setting_id','1')->row();

        if (isset($_POST['filter'])) {
            $bln = $this->input->post('bln');
            $thn = $this->input->post('thn');
            $tipe = $this->input->post('tipe');
            $awal = $thn . '-' . $bln . '-01';
            $akhir = $thn . '-' . $bln . '-31';
            $where = ['date >=' => $awal, 'date <=' => $akhir, 'type ='=>$tipe];
            $data['restock'] = $this->Report_Model->tampildatastocks($where);
            $data['bln'] = $bln;
            $data['thn'] = $thn;
            $data['supplier'] = $this->Admin_Model->tampildata('tb_supplier', 'supplier_id');

            $this->load->view('template/header');
            $this->load->view('report/stock', $data);
            $this->load->view('template/footer');
        } elseif (isset($_POST['cetak'])) {
            $bln = $this->input->post('bln');
            $thn = $this->input->post('thn');
            $tipe = $this->input->post('tipe');
            $awal = $thn . '-' . $bln . '-01';
            $akhir = $thn . '-' . $bln . '-31';
            $where = ['date >=' => $awal, 'date <=' => $akhir, 'type ='=>$tipe];
            $data['restock'] = $this->Report_Model->tampildatastocks($where);
            $data['date'] = indo_date($awal) . ' s/d ' . indo_date($akhir);
            $this->load->view('report/cetak_stock', $data);
        } else {
            $data['restock'] = $this->Report_Model->tampildatastock();
            $data['bln'] = $bln;
            $data['thn'] = $thn;
            $data['supplier'] = $this->Admin_Model->tampildata('tb_supplier', 'supplier_id');

            $this->load->view('template/header');
            $this->load->view('report/stock', $data);
            $this->load->view('template/footer');
        }
    }
    public function report_sale()
    {
        $bln = date('m');
        $thn = date('Y');
        $data['setting'] = $this->Admin_Model->formedit('tb_setting','setting_id','1')->row();

        if (isset($_POST['filter'])) {
            $bln = $this->input->post('bln');
            $thn = $this->input->post('thn');
            $awal = $thn . '-' . $bln . '-01';
            $akhir = $thn . '-' . $bln . '-31';
            $where = ['date >=' => $awal, 'date <=' => $akhir];

            $data['resale'] = $this->Report_Model->tampildatasale($where);
            $data['bln'] = $bln;
            $data['thn'] = $thn;

            $this->load->view('template/header');
            $this->load->view('report/sale', $data);
            $this->load->view('template/footer');
        } elseif (isset($_POST['cetak'])) {
            $bln = $this->input->post('bln');
            $thn = $this->input->post('thn');
            $awal = $thn . '-' . $bln . '-01';
            $akhir = $thn . '-' . $bln . '-31';
            $where = ['date >=' => $awal, 'date <=' => $akhir];
            $data['resale'] = $this->Report_Model->tampildatasale($where);
            $data['date'] = indo_date($awal) . ' s/d ' . indo_date($akhir);
            $this->load->view('report/cetak_sale', $data);
        } else {
            $data['resale'] = $this->Report_Model->tampildatasale();
            $data['bln'] = $bln;
            $data['thn'] = $thn;

            $this->load->view('template/header');
            $this->load->view('report/sale', $data);
            $this->load->view('template/footer');
        }
    }
    public function sale_product($id)
    {
        $sale = $this->Report_Model->tampilproduct($id)->result();
        echo json_encode($sale);
    }
}
