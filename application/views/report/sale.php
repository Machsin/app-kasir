 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Laporan Penjualan
         <small>Reports Sale</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-pie-chart"></i></a></li>
         <li class="active">Data Laporan Penjualan</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <?php $this->view('message') ?>
     <div class="container-fluid">
         <div class="row">
             <div class="box box-primary">
                 <div class="box-header" style="padding-bottom:5px; padding-top:5px;">
                     <h4 class="m-0">Filter Data</h4>
                     <div class="box-tools pull-right">
                         <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                         </button>
                     </div>
                 </div>
                 <div class="box-body row" style="padding-top:0">
                     <form action="<?= base_url('report/report_sale') ?>" method="POST">
                         <div class="col-md-3 col-xs-12">
                             <div class="form-group">
                                 <label for="bulan">Bulan</label>
                                 <select class="form-control" name="bln">
                                     <option value="01" <?php if ($bln == '01') {
                                                            echo 'selected';
                                                        } ?>>Januari</option>
                                     <option value="02" <?php if ($bln == '02') {
                                                            echo 'selected';
                                                        } ?>>Februari</option>
                                     <option value="03" <?php if ($bln == '03') {
                                                            echo 'selected';
                                                        } ?>>Maret</option>
                                     <option value="04" <?php if ($bln == '04') {
                                                            echo 'selected';
                                                        } ?>>April</option>
                                     <option value="05" <?php if ($bln == '05') {
                                                            echo 'selected';
                                                        } ?>>Mei</option>
                                     <option value="06" <?php if ($bln == '06') {
                                                            echo 'selected';
                                                        } ?>>Juni</option>
                                     <option value="07" <?php if ($bln == '07') {
                                                            echo 'selected';
                                                        } ?>>Juli</option>
                                     <option value="08" <?php if ($bln == '08') {
                                                            echo 'selected';
                                                        } ?>>Agustus</option>
                                     <option value="09" <?php if ($bln == '09') {
                                                            echo 'selected';
                                                        } ?>>September</option>
                                     <option value="10" <?php if ($bln == '10') {
                                                            echo 'selected';
                                                        } ?>>Oktober</option>
                                     <option value="11" <?php if ($bln == '11') {
                                                            echo 'selected';
                                                        } ?>>November</option>
                                     <option value="12" <?php if ($bln == '12') {
                                                            echo 'selected';
                                                        } ?>>Desember</option>
                                 </select>
                             </div>
                         </div>

                         <div class="col-md-3 col-xs-12">
                             <div class="form-group">
                                 <label for="tahun">Tahun</label>
                                 <select class="form-control" name="thn">
                                     <?php for ($i = 2016; $i <= 2035; $i++) { ?>
                                         <option value="<?= $i; ?>" <?php if ($thn == $i) {
                                                                        echo 'selected';
                                                                    } ?>>
                                             <?= $i; ?>
                                         </option>
                                     <?php } ?>
                                 </select>
                             </div>
                         </div>

                         <div class="col-md-12 col-xs-12 ">
                             <button type="submit" name="cetak" value="cetak" id="cetak" class="btn btn-success btn-xs" onclick="$('form').attr('target', '_blank');">
                                 <i class="fa fa-print"></i>
                                 Cetak
                             </button>
                             <button type="submit" class="pull-right btn btn-xs btn-primary" name="filter" id="filter" value="filter" onclick="$('form').attr('target', '');">
                                 <i class="fa fa-filter"></i>
                                 Filter
                             </button>
                             <a class="pull-right mr-2 btn btn-xs btn-default" href="<?= base_url('report/report_sale') ?>">Reset</a>
                         </div>

                     </form>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="box">
                 <div class="box-header">
                     <h3 class="box-title">Data Laporan Penjualan</h3>
                 </div>
                 <div class="box-body table-responsive">
                     <table class="table table-bordered table-striped" id="table1">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Invoice</th>
                                 <th>Tanggal</th>
                                 <th>Pelanggan</th>
                                 <th>Total Harga</th>
                                 <th>Diskon</th>
                                 <th>Total Bayar</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $no = 1;
                                foreach ($resale->result() as $key => $data) {
                                ?>
                                 <tr>
                                     <td style="width: 5%"><?= $no++ ?></td>
                                     <td><?= $data->invoice ?></td>
                                     <td><?= indo_date($data->date) ?></td>
                                     <td><?= $data->customer_name == '' ? 'Umum' : $data->customer_name ?></td>
                                     <td><?= indo_currency($data->total_price) ?></td>
                                     <td><?= $data->discount ?></td>
                                     <td><?= indo_currency($data->final_price) ?></td>
                                     <td class="text-center" width="160px">
                                         <a id="set_dtl" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-detail" data-invoice="<?= $data->invoice ?>" data-date="<?= $data->date ?>" data-total="<?= $data->total_price ?>" data-diskon="<?= $data->discount ?>" data-totalbayar="<?= $data->final_price ?>" data-customer="<?= $data->customer_name ?>" data-kasir="<?= $data->user_name ?>" data-tunai="<?= $data->cash ?>" data-kembalian="<?= $data->uang_kembalian ?>" data-saleid="<?= $data->sale_id ?>">
                                             <i class="fa fa-eye"></i> Detail
                                         </a>
                                         <!-- <a href="<?=base_url('sale/cetak/'.$data->sale_id)?>" class="btn btn-primary btn-xs" target="_blank"><i class="fa fa-print"></i> Print -->
                                         <a href="<?=base_url('sale/cetak_struk/'.$data->sale_id)?>" class="btn btn-primary btn-xs"><i class="fa fa-print"></i> Print
                                     </td>
                                 </tr>
                             <?php } ?>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- /.content -->
 <div class="modal fade" tabindex="-1" role="dialog" id="modal-detail">
     <div class="modal-dialog modal-md" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h5 class="modal-title">Detail Penjualan</h5>
             </div>

             <div class="modal-body table-responsive">
                 <table class="table table-bordered no-margin">
                     <tbody>
                         <tr>
                             <th style="width: 20%">Invoice</th>
                             <td style="width: 30%"><b><span id="invoice"></span></b></td>
                             <th style="width: 20%">Pelanggan</th>
                             <td style="width: 30%"><span id="cust"></span></td>
                         </tr>
                         <tr>
                             <th>Tanggal</th>
                             <td><span id="datetime"></span></td>
                             <th>Kasir</th>
                             <td><span id="cashier"></span></td>
                         </tr>
                         <tr>
                             <th>Total</th>
                             <td><span id="total"></span></td>
                             <th>Tunai</th>
                             <td class="bg-success"><span id="cash"></span></td>
                         </tr>
                         <tr>
                             <th>Diskon</th>
                             <td><span id="discount"></span></td>
                             <th>Kembalian</th>
                             <td class="bg-warning"><span id="change"></span></td>
                         </tr>
                         <tr>
                             <th>Total Bayar</th>
                             <td class="bg-info"><span id="grandtotal"></span></td>
                         </tr>
                         <tr>
                             <th>Barang</th>
                             <td colspan="3"><span id="product"></span></td>
                         </tr>
                     </tbody>
                 </table>
             </div>

             <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
             </div>
         </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
 </div><!-- /.modal -->

 <script>
     $(document).ready(function() {
         $(document).on('click', '#set_dtl', function() {
             $("#invoice").text($(this).data('invoice'))
             $("#cust").text($(this).data('customer') == '' ? 'Umum' : $(this).data('customer'))
             $("#datetime").text($(this).data('date'))
             $("#total").text($(this).data('total'))
             $("#discount").text($(this).data('diskon'))
             $("#cash").text($(this).data('tunai'))
             $("#change").text($(this).data('kembalian'))
             $("#grandtotal").text($(this).data('totalbayar'))
             $("#cashier").text($(this).data('kasir'))
             $('#modal-set_dtl').modal('hide');

             var product = '<table class="table table-bordered no-margin">'
             product += '<tr><th>Nama</th><th>Harga</th><th>Jumlah</th><th>Diskon</th><th>Total</th></tr>'
             $.getJSON('<?=base_url('report/sale_product/')?>' + $(this).data('saleid'), function(data) {
                 $.each(data, function(key, val) {
                     product += '<tr><td>' + val.name_item + '</td><td>' + val.price + '</td><td>' + val.qty + '</td><td>' +val.discount_item + '</td><td>' + val.total + '</td></tr>'
                 })
                 product += '</table>'
                 $('#product').html(product)
             })
         })
     })
 </script>