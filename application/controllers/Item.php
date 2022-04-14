<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Item extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['Admin_Model', 'Item_Model']);
        if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
            redirect('login');
        }
    }
    public function index()
    {
        $data['item'] = $this->Item_Model->tampildata();
        $data['itemstock'] = $this->Item_Model->tampildatastok();
        $this->load->view('template/header');
        $this->load->view('product/item/item_data', $data);
        $this->load->view('template/footer');
    }
    public function add()
    {
        $item = new stdClass();
        $item->item_id = null;
        $item->barcode = null;
        $item->image = null;
        $item->name = null;
        $item->price = null;
        $item->price2 = null;
        $item->price3 = null;
        $item->categori_id = null;
        $item->unit_id = null;

        $category = $this->Admin_Model->tampildata('tb_categori', 'categori_id');
        $unit = $this->Admin_Model->tampildata('tb_unit', 'unit_id');
        $data = array(
            'page' => 'tambah',
            'categori' => $category,
            'unit' => $unit,
            'item' => $item
        );
        $this->load->view('template/header');
        $this->load->view('product/item/item_form', $data);
        $this->load->view('template/footer');
    }
    public function edit($id)
    {
        $category = $this->Admin_Model->tampildata('tb_categori', 'categori_id');
        $unit = $this->Admin_Model->tampildata('tb_unit', 'unit_id');
        $query = $this->Admin_Model->formedit('tb_item', 'item_id', $id);
        if ($query->num_rows() > 0) {
            $item = $query->row();
            $data = array(
                'page' => 'edit',
                'categori' => $category,
                'unit' => $unit,
                'item' => $item
            );
            $this->load->view('template/header');
            $this->load->view('product/item/item_form', $data);
            $this->load->view('template/footer');
        } else {
            $this->session->set_flashdata('success', 'Data tidak ditemukan');
            redirect('item');
        }
    }
    public function process()
    {
        $id = $this->input->post('item_id');
        $image = $this->input->post('image');
        $this->form_validation->set_rules('barcode', '', 'required', array('required' => 'Barcode wajib diisi'));
        $this->form_validation->set_rules('name', '', 'required', array('required' => 'Nama Produk wajib diisi'));
        $this->form_validation->set_rules('categori', '', 'required', array('required' => 'Kategori wajib diisi'));
        $this->form_validation->set_rules('unit', '', 'required', array('required' => 'Unit wajib diisi'));
        $this->form_validation->set_rules('price', '', 'required', array('required' => 'Harga Sales wajib diisi'));
        $this->form_validation->set_rules('price2', '', 'required', array('required' => 'Harga Kulakan wajib diisi'));
        $this->form_validation->set_rules('price3', '', 'required', array('required' => 'Harga Jual wajib diisi'));
        if ($this->form_validation->run() == FALSE) {
            if (isset($_POST['tambah'])) {
                $item = new stdClass();
                $item->item_id = null;
                $item->barcode = null;
                $item->image = null;
                $item->name = null;
                $item->price = null;
                $item->price2 = null;
                $item->price3 = null;
                $item->categori_id = null;
                $item->unit_id = null;

                $category = $this->Admin_Model->tampildata('tb_categori', 'categori_id');
                $unit = $this->Admin_Model->tampildata('tb_unit', 'unit_id');
                $data = array(
                    'page' => 'tambah',
                    'categori' => $category,
                    'unit' => $unit,
                    'item' => $item
                );
                $this->load->view('template/header');
                $this->load->view('product/item/item_form', $data);
                $this->load->view('template/footer');
            } else {
                $query = $this->Admin_Model->formedit('tb_item', 'item_id', $id);
                if ($query->num_rows() > 0) {
                    $item = $query->row();
                    $data = array(
                        'page' => 'edit',
                        'item' => $item
                    );
                    $this->load->view('template/header');
                    $this->load->view('product/item/item_form', $data);
                    $this->load->view('template/footer');
                } else {
                    $this->session->set_flashdata('success', 'Data tidak ditemukan');
                    redirect('item');
                }
            }
        } else {
            if (isset($_POST['tambah'])) {
                $config['upload_path']    = './assets/image/barang/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']    = 2048;
                $config['file_name']    = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->load->library('upload', $config);
                if ($_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $data = array(
                            'barcode' => $this->input->post('barcode'),
                            'name' => $this->input->post('name'),
                            'categori_id' => $this->input->post('categori'),
                            'unit_id' => $this->input->post('unit'),
                            'price' => $this->input->post('price'),
                            'price2' => $this->input->post('price2'),
                            'price3' => $this->input->post('price3'),
                            'image' => $this->upload->data('file_name'),
                        );
                        $this->Admin_Model->simpandata('tb_item', $data);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('item');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        $item = new stdClass();
                        $item->item_id = null;
                        $item->image = null;
                        $item->barcode = null;
                        $item->name = null;
                        $item->price = null;
                        $item->price2 = null;
                        $item->price3 = null;
                        $item->categori_id = null;
                        $item->unit_id = null;

                        $category = $this->Admin_Model->tampildata('tb_categori', 'categori_id');
                        $unit = $this->Admin_Model->tampildata('tb_unit', 'unit_id');
                        $data = array(
                            'page' => 'tambah',
                            'categori' => $category,
                            'unit' => $unit,
                            'item' => $item
                        );
                        $this->load->view('template/header');
                        $this->load->view('product/item/item_form', $data);
                        $this->load->view('template/footer');
                    }
                } else {
                    $data = array(
                        'barcode' => $this->input->post('barcode'),
                        'name' => $this->input->post('name'),
                        'categori_id' => $this->input->post('categori'),
                        'unit_id' => $this->input->post('unit'),
                        'price' => $this->input->post('price'),
                        'price2' => $this->input->post('price2'),
                        'price3' => $this->input->post('price3'),
                    );
                    $this->Admin_Model->simpandata('tb_item', $data);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('item');
                }
            } else if (isset($_POST['edit'])) {
                $config['upload_path']    = './assets/image/product';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']    = 2048;
                $config['file_name']    = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
                $this->load->library('upload', $config);
                if ($_FILES['image']['name'] != null) {
                    unlink('./assets/image/product/' . $image);
                    if ($this->upload->do_upload('image')) {
                        $data = array(
                            'barcode' => $this->input->post('barcode'),
                            'name' => $this->input->post('name'),
                            'categori_id' => $this->input->post('categori'),
                            'unit_id' => $this->input->post('unit'),
                            'price' => $this->input->post('price'),
                            'price2' => $this->input->post('price2'),
                            'price3' => $this->input->post('price3'),
                            'image' => $this->upload->data('file_name'),
                        );
                        $this->Admin_Model->editdata('tb_item', 'item_id', $id, $data);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('item');
                    } else {
                        $category = $this->Admin_Model->tampildata('tb_categori', 'categori_id');
                        $unit = $this->Admin_Model->tampildata('tb_unit', 'unit_id');
                        $query = $this->Admin_Model->formedit('tb_item', 'item_id', $id);
                        if ($query->num_rows() > 0) {
                            $item = $query->row();
                            $data = array(
                                'page' => 'edit',
                                'categori' => $category,
                                'unit' => $unit,
                                'item' => $item
                            );
                            $this->load->view('template/header');
                            $this->load->view('product/item/item_form', $data);
                            $this->load->view('template/footer');
                        } else {
                            $this->session->set_flashdata('success', 'Data tidak ditemukan');
                            redirect('item');
                        }
                    }
                } else {
                    $data = array(
                        'barcode' => $this->input->post('barcode'),
                        'name' => $this->input->post('name'),
                        'categori_id' => $this->input->post('categori'),
                        'unit_id' => $this->input->post('unit'),
                        'price' => $this->input->post('price'),
                        'price2' => $this->input->post('price2'),
                        'price3' => $this->input->post('price3'),
                    );
                    $this->Admin_Model->editdata('tb_item', 'item_id', $id, $data);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('item');
                }
            }
        }
    }
    public function delete($id)
    {
        $this->Admin_Model->hapusdata('tb_item', $id, 'item_id');
        if ($this->db->affected_rows()) {
            $this->session->set_flashdata('success', 'Data item berhasil terhapus');
        } else {
            $this->session->set_flashdata('error', 'Data item gagal terhapus');
        }
        redirect('item');
    }
    function barcode_qrcode($id)
    {
        $data['row'] = $this->Admin_Model->formedit('tb_item', 'item_id', $id)->row();
        // $this->template->load('template', 'item/barcode_qrcode', $data);
        $this->load->view('template/header');
        $this->load->view('product/item/barcode_qrcode', $data);
        $this->load->view('template/footer');
    }
    function barcode_print($id)
    {
        $data['row'] = $this->Admin_Model->formedit('tb_item', 'item_id', $id)->row();
        // $this->template->load('template', 'item/barcode_qrcode', $data);
        $this->load->view('product/item/barcode_print', $data);
    }
    function qrcode_print($id)
    {
        $data['row'] = $this->Admin_Model->formedit('tb_item', 'item_id', $id)->row();
        // $this->template->load('template', 'item/barcode_qrcode', $data);
        $this->load->view('product/item/qrcode_print', $data);
    }
    public function getitem()
    {
        $setting = $this->Admin_Model->formedit('tb_setting','setting_id','1')->row();
        if (isset($_POST['add_item'])) {
            $item_id = $this->input->post('item_id');
            $item = $this->Item_Model->tampildata($item_id);
            if ($item->num_rows() > 0) {
                $item = $this->Item_Model->tampildata($item_id)->row();
                if($setting->kategori_harga == 'kulakan'){
                    $harga = $item->price2;
                }else{
                    $harga = $item->price3;
                }
                $params = array(
                    "success" => true,
                    "item_id" => $item->item_id,
                    "item_name" => $item->name,
                    "unit_name"    => $item->unit_name,
                    "stock"      => $item->stock,
                    "price"      => $harga,
                );
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }
}
