 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Unit Barang
         <small>Units Data</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-archive"></i></a></li>
         <li class="active">Data Unit Barang</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <?php $this->view('message') ?>
     <div class="box">
         <div class="box-header">
             <h3 class="box-title">Data Unit Barang</h3>
             <div class="pull-right">
                 <a href="<?= base_url('unit/add') ?>" class="btn btn-primary btn-flat">
                     <i class="fa fa-plus"></i> Tambah Data
                 </a>
             </div>
         </div>
         <div class="box-body table-responsive">
             <table class="table table-bordered table-striped" id="table1">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Nama</th>
                         <th>Ditambah</th>
                         <th>Diupdate</th>
                         <th>Actions</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $no = 1;
                        foreach ($unit->result() as $key => $data) {
                        ?>
                         <tr>
                             <td style="width: 5%"><?= $no++ ?></td>
                             <td><?= $data->name ?></td>
                             <td><?= indo_date2($data->created) ?></td>
                             <td><?= $data->updated == '' ? '-' :indo_date2($data->updated)?></td>
                             <td class="text-center" width="160px">
                                 <a href="<?= base_url('unit/edit/' . $data->unit_id) ?>" class="btn btn-primary btn-xs">
                                     <i class="fa fa-unit-pencil"></i> Edit
                                 </a>
                                 <a href="<?= base_url('unit/delete/' . $data->unit_id) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin')">
                                     <i class="fa fa-unit-trash"></i> Hapus
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