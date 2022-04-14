 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Laporan Stok
         <small>Reports Stock</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-pie-chart"></i></a></li>
         <li class="active">Data Laporan Stok</li>
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
                     <form action="<?= base_url('report/report_stock') ?>" method="POST">
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
                         <div class="col-md-3 col-xs-12">
                             <div class="form-group">
                                 <label for="Tipe">Tipe</label>
                                 <select class="form-control" name="tipe">
                                     <option value="masuk" <?=$tipe=='masuk'?'selected':null?>>Masuk</option>
                                     <option value="keluar" <?=$tipe=='keluar'?'selected':null?>>Keluar</option>
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
                             <a class="pull-right mr-2 btn btn-xs btn-default" href="<?= base_url('report/report_stock') ?>">Reset</a>
                         </div>

                     </form>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="box">
                 <div class="box-header">
                     <h3 class="box-title">Data Laporan Stok</h3>
                 </div>
                 <div class="box-body table-responsive">
                     <table class="table table-bordered table-striped" id="table1">
                         <thead>
                             <tr>
                                 <th>#</th>
                                 <th>Tipe</th>
                                 <th>Tanggal</th>
                                 <th>Pengguna</th>
                                 <th>Supplier</th>
                                 <th>Nama Barang</th>
                                 <th>Jumlah</th>
                                 <th>Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $no = 1;
                                foreach ($restock->result() as $key => $data) {
                                ?>
                                 <tr>
                                     <td style="width: 5%"><?= $no++ ?></td>
                                     <td><?= $data->type ?></td>
                                     <td><?= indo_date($data->date) ?></td>
                                     <td><?= $data->user_name ?></td>
                                     <td><?= $data->supplier_name == '' ? '-' : $data->supplier_name ?></td>
                                     <td><?= $data->item_name ?></td>
                                     <td><?= $data->qty ?></td>
                                     <td class="text-center" width="160px">
                                         <a id="set_dtl" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modal-detail" data-type="<?= $data->type ?>" data-date="<?= $data->date ?>" data-user_name="<?= $data->user_name ?>" data-supplier_name="<?= $data->supplier_name ?>" data-detail="<?= $data->detail ?>" data-item="<?= $data->item_name ?>" data-harga="<?= $data->price ?>" data-qty="<?= $data->qty ?>" data-total="<?= $data->total ?>">
                                             <i class="fa fa-eye"></i> Detail
                                         </a>
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
     <div class="modal-dialog modal-sm" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                 <h5 class="modal-title">Detail Stok</h5>
             </div>

             <div class="modal-body table-responsive">
                 <table class="table table-bordered no-margin">
                     <tbody>
                         <tr>
                             <th style="width: 20%">Tipe</th>
                             <td style="width: 30%"><b><span id="type2"></span></b></td>
                         </tr>
                         <tr>
                             <th>Tanggal</th>
                             <td><b><span id="date2"></span></b></td>
                         </tr>
                         <tr>
                             <th>Pengguna</th>
                             <td><b><span id="username2"></span></b></td>
                         </tr>
                         <tr>
                             <th>Pemasok</th>
                             <td><b><span id="supplier2"></span></b></td>
                         </tr>
                         <tr>
                             <th>Detail</th>
                             <td><b><span id="detail2"></span></b></td>
                         </tr>
                         <tr>
                             <th>Nama Barang</th>
                             <td><b><span id="itemname2"></span></b></td>
                         </tr>
                         <tr>
                             <th>Harga Beli</th>
                             <td><b><span id="purchaseprice2"></span></b></td>
                         </tr>
                         <tr>
                             <th>Jumlah</th>
                             <td><b><span id="qty2"></span></b></td>
                         </tr>
                         <tr>
                             <th>Total Harga</th>
                             <td><b><span id="totalprice2"></span></b></td>
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
             var type = $(this).data('type');
             var date = $(this).data('date');
             var username = $(this).data('user_name');
             var supplier_name = $(this).data('supplier_name') == '' ? '-' : $(this).data('supplier_name');
             var detail = $(this).data('detail');
             var item_name = $(this).data('item');
             var harga = $(this).data('harga');
             var qty = $(this).data('qty');
             var total = $(this).data('total');
             $('#type2').text(type);
             $('#date2').text(date);
             $('#username2').text(username);
             $('#supplier2').text(supplier_name);
             $('#detail2').text(detail);
             $('#itemname2').text(item_name);
             $('#purchaseprice2').text(harga);
             $('#qty2').text(qty);
             $('#totalprice2').text(total);
             $('#modal-set_dtl').modal('hide');

         })
     })
 </script>