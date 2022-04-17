<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sale extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(['Admin_Model', 'Sale_Model', 'Item_Model']);
        if (empty($this->session->userdata('username')) and empty($this->session->userdata('password'))) {
            redirect('login');
        }
    }
    public function index()
    {
        $data['setting'] = $this->Admin_Model->formedit('tb_setting', 'setting_id', '1')->row();
        $data['customer'] = $this->Admin_Model->tampildata('tb_customer', 'customer_id');
        $data['item'] = $this->Item_Model->tampilitemsale();
        $data['cart'] = $this->Sale_Model->get_cart();
        $data['invoice'] = $this->Sale_Model->invoice_no();
        $this->load->view('template/header');
        $this->load->view('transaction/sale/sale_form', $data);
        $this->load->view('template/footer');
    }
    public function cart_data()
    { 
        $data['cart'] = $this->Sale_Model->get_cart();
        $this->load->view('transaction/sale/cart_data', $data);
    }
    public function process()
    {
        $post = $this->input->post(null, true);

        if (isset($_POST['add_cart'])) {

            $item_id = $this->input->post('item_id');
            $cek_cart = $this->Sale_Model->get_cart(['tb_cart.item_id' => $item_id]);
            if ($cek_cart->num_rows() > 0) {
                $this->Sale_Model->update_cart_qty($post);
            } else {
                $this->Sale_Model->add_cart($post);
            }

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
        if (isset($_POST['process_payment'])) {
            $sale_id = $this->Sale_Model->add_sale($post);
            $cart = $this->Sale_Model->get_cart()->result();
            $row = [];


            foreach ($cart as $c) {
                array_push($row, [
                    'sale_id' => $sale_id,
                    'item_id' => $c->item_id,
                    'price' => $c->cart_price,
                    'qty' => $c->qty,
                    'discount_item' => $c->discount_item,
                    'total' => $c->total
                ]);
            }

            $this->Sale_Model->add_sale_detail($row);
            $userid = $this->session->userdata('user_id');
            $this->Admin_Model->hapusdata('tb_cart', $userid, 'user_id');
            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true, "sale_id" => $sale_id);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        }
    }
    public function edit()
    {
        $id = $this->input->post('cart_id');
        $data = $this->Sale_Model->get($id)->row_array();
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    public function update()
    {
        $post = $this->input->post();
        $this->Sale_Model->update_cart($post);
        $this->session->set_flashdata('pesan', 'Cart berhasil diupdate.');
        redirect('sale');
    }
    public function cart_del($id)
    {
        $this->Admin_Model->hapusdata('tb_cart', $id, 'cart_id');
        $this->session->set_flashdata('pesan', 'Cart berhasil di hapus!');
        redirect('sale');
    }
    public function reset()
    {
        if (isset($_POST['cancel_payment'])) {
            $userid = $this->session->userdata('user_id');
            $this->Admin_Model->hapusdata('tb_cart', $userid, 'user_id');
            if ($this->db->affected_rows() > 0) {
                $params = array("success" => true);
            } else {
                $params = array("success" => false);
            }
            echo json_encode($params);
        } 
    }
    public function cetak($id)
    {
        $data['setting'] = $this->Admin_Model->formedit('tb_setting','setting_id','1')->row();
        $data['sale'] = $this->Sale_Model->get_sale($id)->row();
        $data['sale_detail'] = $this->Sale_Model->get_sale_detail($id)->result();
        $this->load->view('transaction/sale/print_struk', $data);
    }
    public function cetak_struk() {
        // me-load library escpos
        $this->load->library('escpos');

        // membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("printer_a");

        // membuat objek $printer agar dapat di lakukan fungsinya
        $printer = new Escpos\Printer($connector);

        // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
        function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 12;
            $lebar_kolom_2 = 8;
            $lebar_kolom_3 = 8;
            $lebar_kolom_4 = 9;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
            $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
            $kolom4Array = explode("\n", $kolom4);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }   

        // Membuat judul
        $printer->initialize();
        $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->text("Nama Toko\n");
        $printer->text("\n");

        // Data transaksi
        $printer->initialize();
        $printer->text("Kasir : Badar Wildanie\n");
        $printer->text("Waktu : 13-10-2019 19:23:22\n");

        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom("Barang", "qty", "Harga", "Subtotal"));
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom("Makaroni 250gr", "2pcs", "15.000", "30.000"));
        $printer->text(buatBaris4Kolom("Telur", "2pcs", "5.000", "10.000"));
        $printer->text(buatBaris4Kolom("Tepung terigu", "1pcs", "8.200", "16.400"));
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom('', '', "Total", "56.400"));
        $printer->text("\n");

         // Pesan penutup
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text("Terima kasih telah berbelanja\n");
        $printer->text("http://badar-blog.blogspot.com\n");

        $printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
        $printer->close();
    }
    // public function cetak_struka($id) {
    //     $setting= $this->Admin_Model->formedit('tb_setting','setting_id','1')->row();
    //     $sale= $this->Sale_Model->get_sale($id)->row();
    //     $sale_detail= $this->Sale_Model->get_sale_detail($id)->result();

    //     // me-load library escpos
    //     $this->load->library('escpos');

    //     // membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
    //     $connector = new Escpos\PrintConnectors\WindowsPrintConnector("printer_a");

    //     // membuat objek $printer agar dapat di lakukan fungsinya
    //     $printer = new Escpos\Printer($connector);

    //     // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
    //     function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4) {
    //         // Mengatur lebar setiap kolom (dalam satuan karakter)
    //         $lebar_kolom_1 = 12;
    //         $lebar_kolom_2 = 8;
    //         $lebar_kolom_3 = 8;
    //         $lebar_kolom_4 = 9;

    //         // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
    //         $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
    //         $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
    //         $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
    //         $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

    //         // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
    //         $kolom1Array = explode("\n", $kolom1);
    //         $kolom2Array = explode("\n", $kolom2);
    //         $kolom3Array = explode("\n", $kolom3);
    //         $kolom4Array = explode("\n", $kolom4);

    //         // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
    //         $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));

    //         // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
    //         $hasilBaris = array();

    //         // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
    //         for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

    //             // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
    //             $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
    //             $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

    //             // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
    //             $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
    //             $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

    //             // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
    //             $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
    //         }

    //         // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
    //         return implode($hasilBaris, "\n") . "\n";
    //     }   

    //     // Membuat judul
    //     $printer->initialize();
    //     $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
    //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
    //     $printer->text("$setting->nama_toko\n");
    //     $printer->text("\n");
    //     $printer->text("Alamat : $setting->address");
    //     $printer->text("\n");
    //     $printer->text("Telp : $setting->phone");
    //     $printer->text("\n");

    //     // Data transaksi
    //     $printer->initialize();
    //     $printer->text("Invoice : ".$sale->invoice."\n");
    //     $printer->text("Kasir   : ".ucfirst($sale->user_name)."\n");
    //     $printer->text("Waktu   : ".date('d/m/Y', strtotime($sale->date)) . " " . date('H:i', strtotime($sale->sale_created))."\n");

    //     // Membuat tabel
    //     $printer->initialize(); // Reset bentuk/jenis teks
    //     $printer->text("----------------------------------------\n");
    //     $printer->text(buatBaris4Kolom("Barang", "qty", "Harga", "Total"));
    //     $printer->text("----------------------------------------\n");

    //     $arr_discount = [];
    //     foreach ($sale_detail as $sd) {
    //         $printer->text(buatBaris4Kolom("$sd->name", "$sd->qty.$sd->name_unit", "".indo_currency($sd->price)."", "".indo_currency(($sd->price - $sd->discount_item) * $sd->qty).""));
    //         if ($sd->discount_item > 0) {
    //             $arr_discount[] = $sd->discount_item;
    //         }
    //     }
    //     $printer->text("\n");
    //     foreach ($arr_discount as $ad) {
    //         $printer->text(buatBaris4Kolom("", "", "Disk.".$ad,indo_currency($ad)));    
    //     }
    //     $printer->text("----------------------------------------\n");
    //     $printer->text(buatBaris4Kolom('', '', "Total Awal",indo_currency($sale->total_price)));
    //     if ($sale->discount > 0) {
    //         $printer->text(buatBaris4Kolom('', '', "Diskon Penjualan",indo_currency($sale->discount)));
    //     }
    //     $printer->text(buatBaris4Kolom("", "", "Total Akhir", indo_currency($sale->final_price)));
    //     $printer->text(buatBaris4Kolom("", "", "Bayar", indo_currency($sale->cash)));
    //     $printer->text(buatBaris4Kolom("", "", "Kembalian", indo_currency($sale->uang_kembalian)));

    //     $printer->text("\n");

    //      // Pesan penutup
    //     $printer->initialize();
    //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
    //     $printer->text("Terima kasih telah berbelanja\n");

    //     $printer->feed(5); // mencetak 5 baris kosong agar terangkat (pemotong kertas saya memiliki jarak 5 baris dari toner)
    //     $printer->close();
    //     if($sale_detail->num_rows() >0){
    //         redirect('sale');
    //     }
    // }
}
