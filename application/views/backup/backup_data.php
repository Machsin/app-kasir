 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Backup & Restore Database
         <small>Backup & Restore Databases</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-users"></i></a></li>
         <li class="active">Backup & Restore Database</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <?php $this->view('message') ?>
     <div class="col-md-6">
         <div class="box">
             <div class="box-header">
                 <h3 class="box-title">Backup Database</h3>
             </div>
             <div class="box-body table-responsive">
                 <a href="<?= base_url('backup/backup') ?>" class="btn btn-primary btn-flat">
                     <i class="fa fa-database"></i> Backup Data
                 </a>
             </div>
         </div>
     </div>
     <div class="col-md-6">
         <div class="box">
             <div class="box-header">
                 <h3 class="box-title">Restore Database</h3>
             </div>
             <div class="box-body table-responsive">
                 <?php echo form_open_multipart('backup/restore')  ?>
                 <div class="form-group">
                     <label>Database</label>
                     <input type="file" name="db" class="form-control">
                     <!-- <?= form_error('db_name') ?> -->
                 </div>
                 <div class="form-group">
                     <button type="submit" class="btn btn-primary btn-flat">
                         <i class="fa fa-paper-plane"></i> Kirim</button>
                 </div>
                 <?php echo form_close() ?>
             </div>
         </div>
     </div>
 </section>
 <!-- /.content -->