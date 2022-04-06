 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Pengguna
         <small>Users Data</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-user"></i></a></li>
         <li class="active">Data Pengguna</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <?php $this->view('message') ?>
     <div class="box">
         <div class="box-header">
             <h3 class="box-title">Data Pengguna</h3>
             <div class="pull-right">
                 <a href="<?= site_url('user/add') ?>" class="btn btn-primary btn-flat">
                     <i class="fa fa-user-plus"></i> Tambah Data
                 </a>
             </div>
         </div>
         <div class="box-body table-responsive">
             <table class="table table-bordered table-striped" id="table1">
                 <thead>
                     <tr>
                         <th>#</th>
                         <th>Username</th>
                         <th>Nama</th>
                         <th>Alamat</th>
                         <th>Level</th>
                         <th>Aksi</th>
                     </tr>
                 </thead>
                 <tbody>
                     <?php $no = 1;
                        foreach ($user->result() as $key => $data) {
                        ?>
                         <tr>
                             <td><?= $no++ ?></td>
                             <td><?= $data->username ?></td>
                             <td><?= $data->name ?></td>
                             <td><?= $data->address ?></td>
                             <td><?= $data->level == 1 ? "Admin" : "Kasir " ?></td>
                             <td class="text-center" width="160px">
                                 <a href="<?= site_url('user/edit/' . $data->user_id) ?>" class="btn btn-primary btn-xs">
                                     <i class="fa fa-user-pencil"></i> Edit
                                 </a>
                                 <a href="<?= site_url('user/delete/' . $data->user_id) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin ingin menghapus data ini')">
                                     <i class="fa fa-user-trash"></i> Hapus
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