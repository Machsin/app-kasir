 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Pelanggan
         <small>Customers Data</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-users"></i></a></li>
         <li class="active">Data Pelanggan</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <?php $this->view('message') ?>
     <div class="box">
         <div class="box-header">
             <h3 class="box-title">Data Pelanggan</h3>
             <div class="pull-right">
                 <a href="<?= base_url('customer/add') ?>" class="btn btn-primary btn-flat">
                     <i class="fa fa-user-plus"></i> Tambah Data
                 </a>
             </div>
         </div>
         <div class="box-body table-responsive">
             <table class="table table-bordered table-striped" id="table1">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Name</th>
                         <th>JK</th>
                         <th>No. Hp</th>
                         <th>Alamat</th>
                         <th>Ditambah</th>
                         <th>Diupdate</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $no = 1;
                        foreach ($customer->result() as $key => $data) {
                        ?>
                         <tr>
                             <td style="width: 5%"><?= $no++ ?></td>
                             <td><?= $data->name ?></td>
                             <td><?= $data->gender == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                             <td><?= $data->phone ?></td>
                             <td><?= $data->address ?></td>
                             <td><?= indo_date2($data->created) ?></td>
                             <td><?= $data->updated =='' ? '-' : indo_date2($data->updated) ?></td>
                             <td class="text-center" width="160px">
                                 <a href="<?= base_url('customer/edit/' . $data->customer_id) ?>" class="btn btn-primary btn-xs">
                                     <i class="fa fa-customer-pencil"></i> Edit
                                 </a>
                                 <a href="<?= base_url('customer/delete/' . $data->customer_id) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin')">
                                     <i class="fa fa-customer-trash"></i> Hapus
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