 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Penggaturan
         <small>Settings Data</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-user"></i></a></li>
         <li class="active">Data Pengaturan</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <?php $this->view('message') ?>
     <div class="box">
         <div class="box-header">
         </div>
         <div class="box-body table-responsive">
             <div class="row">
                 <div class="col-md-4 col-md-offset-1">
                     <form action="<?= base_url('setting/process') ?>" method="post">
                         <!-- <?= validation_errors() ?> -->
                         <input type="hidden" name="setting_id" value="<?= $setting->setting_id ?>">
                         <div class="form-group <?= form_error('setting_name') ? 'has-error' : null ?>">
                             <label>Nama Toko*</label>
                             <input type="text" name="setting_name" value="<?= $setting->nama_toko == '' ? set_value('setting_name') : $setting->nama_toko  ?>" class="form-control">
                             <?= form_error('setting_name') ?>
                         </div>
                         <div class="form-group <?= form_error('pemilik') ? 'has-error' : null ?>">
                             <label>Pemilik Toko *</label>
                             <input type="text" name="pemilik" value="<?= $setting->pemilik_toko == '' ? set_value('pemilik') : $setting->pemilik_toko ?>" class="form-control">
                             <?= form_error('pemilik') ?>
                         </div>
                         <div class="form-group <?= form_error('telp') ? 'has-error' : null ?>">
                             <label>No. Telepon *</label>
                             <input type="number" name="telp" value="<?= $setting->phone == '' ? set_value('telp') : $setting->phone ?>" class="form-control">
                             <?= form_error('telp') ?>
                         </div>
                         <div class="form-group <?= form_error('alamat') ? 'has-error' : null ?>">
                             <label>Alamat * </label>
                             <textarea name="alamat" class="form-control"><?= $setting->address ?></textarea>
                             <?= form_error('alamat') ?>
                         </div>
                         <div class="form-group <?= form_error('struk') ? 'has-error' : null ?>">
                             <label>Kode Struk * </label>
                             <div class="row">
                                 <div class="col-xs-3">
                                     <input type="text" minlength="2" maxlength="2" name="struk" value="<?= $setting->kode_struk == '' ? set_value('struk') : $setting->kode_struk ?>" class="form-control">
                                     <?= form_error('struk') ?>
                                 </div>
                                 <div class="input-group">
                                     <div class="input-group-addon">
                                         Hasil :</i>
                                     </div>
                                     <input type="text" class="form-control" value="<?= $invoice ?>" readonly>
                                 </div>
                             </div>
                         </div>
                         <div class="form-group <?= form_error('barcode') ? 'has-error' : null ?>">
                             <label>Kode Barcode * </label>
                             <div class="row">
                                 <div class="col-xs-3">
                                     <input type="text" minlength="1" maxlength="1" name="barcode" value="<?= $setting->kode_barcode == '' ? set_value('barcode') : $setting->kode_barcode ?>" class="form-control">
                                     <?= form_error('barocode') ?>
                                 </div>
                                 <div class="input-group">
                                     <div class="input-group-addon">
                                         Hasil :</i>
                                     </div>
                                     <input type="text" class="form-control" value="<?= $setting->kode_barcode ?>0001" readonly>
                                 </div>
                             </div>
                         </div>
                         <!-- <label class="switch">
                             <input type="checkbox">
                             <span class="slider round"></span>
                         </label> -->
                         <div class="form-group">
                             <button type="submit" name="edit" class="btn btn-success btn-flat">
                                 <i class="fa fa-paper-plane"></i> Save</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- /.content -->