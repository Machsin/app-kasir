 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Pelanggan
         <small>Customers</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-user"></i></a></li>
         <li class="active">Data Pelanggan</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <div class="box">
         <div class="box-header">
             <h3 class="box-title"><?= ucfirst($page) ?> Data Pelanggan</h3>
             <div class="pull-right">
                 <a href="<?= base_url('customer') ?>" class="btn btn-warning btn-flat">
                     <i class="fa fa-undo"></i> Back
                 </a>
             </div>
         </div>
         <div class="box-body table-responsive">
             <div class="row">
                 <div class="col-md-4 col-md-offset-4">
                     <form action="<?= base_url('customer/process') ?>" method="post">
                         <!-- <?= validation_errors() ?> -->
                         <input type="hidden" name="customer_id" value="<?= $customer->customer_id ?>">
                         <div class="form-group <?= form_error('customer_name') ? 'has-error' : null ?>">
                             <label>Nama *</label>
                             <input type="text" name="customer_name" value="<?= $customer->name == '' ? set_value('customer_name') : $customer->name  ?>" class="form-control">
                             <?= form_error('customer_name') ?>
                         </div>
                         <div class="form-group <?= form_error('gender') ? 'has-error' : null ?>">
                             <label>Jenis Kelamin *</label>
                             <select name="gender" class="form-control">
                                 <option value="">- Pilih -</option>
                                 <option value="L" <?= $customer->gender == "L" ? 'selected' : null ?>>Laki-laki</option>
                                 <option value="P" <?= $customer->gender == 'P' ? 'selected' : null ?>>Perempuan</option>
                             </select>
                             <?= form_error('customer_name') ?>
                         </div>
                         <div class="form-group <?= form_error('phone') ? 'has-error' : null ?>">
                             <label>No. Telepon *</label>
                             <input type="number" name="phone" value="<?= $customer->phone == '' ? set_value('phone') : $customer->phone ?>" class="form-control">
                             <?= form_error('phone') ?>
                         </div>
                         <div class="form-group <?= form_error('address') ? 'has-error' : null ?>">
                             <label>Alamat *</label>
                             <textarea name="address" class="form-control"><?= $customer->address == '' ? set_value('address') : $customer->address ?></textarea>
                             <?= form_error('address') ?>
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