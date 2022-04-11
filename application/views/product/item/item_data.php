 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Barang
         <small>Items Data</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-archive"></i></a></li>
         <li class="active">Data Barang</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <?php $this->view('message') ?>
     <div class="box">
         <div class="box-header">
             <h3 class="box-title">Data Barang</h3>
             <div class="pull-right">
                 <a href="<?= base_url('item/add') ?>" class="btn btn-primary btn-flat">
                     <i class="fa fa-plus"></i> Tambah Data
                 </a>
             </div>
         </div>
         <div class="box-body table-responsive">
             <table class="table table-bordered table-striped" id="table1">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Barcode</th>
                         <th>Nama</th>
                         <th>Kategori</th>
                         <th>Satuan</th>
                         <th>Harga Jual</th>
                         <th>Stok</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $no = 1;
                        foreach ($item->result() as $key => $data) {
                        ?>
                         <tr>
                             <td style="width: 5%"><?= $no++ ?></td>
                             <td><?= $data->barcode ?><br>
                                 <a href="<?= base_url('item/barcode_qrcode/' . $data->item_id) ?>" class="btn btn-default btn-xs">
                                     Generate <i class="fa fa-barcode"></i>
                                 </a>
                             </td>
                             <td><?= $data->name ?></td>
                             <td><?= $data->categori_name ?></td>
                             <td><?= $data->unit_name ?></td>
                             <td><?= $data->price ?></td>
                             <td><?= $data->stock ?></td>
                             <td class="text-center" width="160px">
                                 <a href="<?= base_url('item/edit/' . $data->item_id) ?>" class="btn btn-primary btn-xs">
                                     <i class="fa fa-item-pencil"></i> Edit
                                 </a>
                                 <a href="<?= base_url('item/delete/' . $data->item_id) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin')">
                                     <i class="fa fa-item-trash"></i> Hapus
                                 </a>
                             </td>
                         </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </section>
 <!-- /.content -->