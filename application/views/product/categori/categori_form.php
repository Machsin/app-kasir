 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Kategori Barang
         <small>Categories Data</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-user"></i></a></li>
         <li class="active">Data Kategori Barang</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <div class="box">
         <div class="box-header">
             <h3 class="box-title"><?= ucfirst($page) ?> Data Kategori Barang</h3>
             <div class="pull-right">
                 <a href="<?= base_url('categori') ?>" class="btn btn-warning btn-flat">
                     <i class="fa fa-undo"></i> Back
                 </a>
             </div>
         </div>
         <div class="box-body table-responsive">
             <div class="row">
                 <div class="col-md-4 col-md-offset-4">
                     <form action="<?= base_url('categori/process') ?>" method="post">
                         <!-- <?= validation_errors() ?> -->
                         <input type="hidden" name="categori_id" value="<?= $categori->categori_id ?>">
                         <div class="form-group <?= form_error('categori_name') ? 'has-error' : null ?>">
                             <label>Nama *</label>
                             <input type="text" name="categori_name" value="<?= $categori->name == '' ? set_value('categori_name') : $categori->name  ?>" class="form-control">
                             <?= form_error('categori_name') ?>
                         </div>
                         <div class="form-group">
                             <button type="submit" name="<?= $page ?>" class="btn btn-success btn-flat">
                                 <i class="fa fa-paper-plane"></i> Save</button>
                             <button type="reset" class="btn btn-flat">Reset</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- /.content -->