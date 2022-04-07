 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Pemasok Barang
         <small>Suppliers Data</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-user"></i></a></li>
         <li class="active">Data Pemasok Barang</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <div class="box">
         <div class="box-header">
             <h3 class="box-title"><?= ucfirst($page) ?> Data Pemasok Barang</h3>
             <div class="pull-right">
                 <a href="<?= base_url('supplier') ?>" class="btn btn-warning btn-flat">
                     <i class="fa fa-undo"></i> Back
                 </a>
             </div>
         </div>
         <div class="box-body table-responsive">
             <div class="row">
                 <div class="col-md-4 col-md-offset-4">
                     <form action="<?= base_url('supplier/process') ?>" method="post">
                         <!-- <?= validation_errors() ?> -->
                         <input type="hidden" name="supplier_id" value="<?= $supplier->supplier_id ?>">
                         <div class="form-group <?= form_error('supplier_name') ? 'has-error' : null ?>">
                             <label>Nama *</label>
                             <input type="text" name="supplier_name" value="<?= $supplier->name == '' ? set_value('supplier_name') : $supplier->name  ?>" class="form-control">
                             <?= form_error('supplier_name') ?>
                         </div>
                         <div class="form-group <?= form_error('phone') ? 'has-error' : null ?>">
                             <label>No. Telepon *</label>
                             <input type="number" name="phone" value="<?= $supplier->phone == '' ? set_value('phone') : $supplier->phone ?>" class="form-control">
                             <?= form_error('phone') ?>
                         </div>
                         <div class="form-group <?= form_error('address') ? 'has-error' : null ?>">
                             <label>Alamat *</label>
                             <textarea name="address" class="form-control"><?= $supplier->address == '' ? set_value('address') : $supplier->address ?></textarea>
                             <?= form_error('address') ?>
                         </div>
                         <div class="form-group">
                             <label>Deskripsi </label>
                             <textarea name="desc" class="form-control"><?= $supplier->description ?></textarea>
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