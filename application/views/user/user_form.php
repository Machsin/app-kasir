 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Pengguna
         <small>Users Data</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-user"></i></a></li>
         <li class="active"><?= $title ?></li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <div class="box">
         <div class="box-header">
             <h3 class="box-title"><?= $title ?></h3>
             <div class="pull-right">
                 <a href="<?= site_url('user') ?>" class="btn btn-warning btn-flat">
                     <i class="fa fa-undo"></i> Kembali
                 </a>
             </div>
         </div>
         <div class="box-body">
             <div class="row">
                 <div class="col-md-4 col-md-offset-4">
                     <?php echo form_open_multipart('user/process') ?>
                     <!-- <?= validation_errors() ?> -->
                     <input type="hidden" value="<?= $user->user_id ?>" name="user_id">
                     <div class="form-group <?= form_error('fullname') ? 'has-error' : null ?>">
                         <label>Nama *</label>
                         <input type="text" name="fullname" value="<?= $user->name == '' ? set_value('fullname') : $user->name  ?>" class="form-control" placeholder="Masukkan Nama">
                         <?= form_error('fullname') ?>
                     </div>
                     <div class="form-group <?= form_error('username') ? 'has-error' : null ?>">
                         <label>Username *</label>
                         <input type="text" name="username" value="<?= $user->username == '' ? set_value('username') : $user->username  ?>" class="form-control" placeholder="Masukkan Username">
                         <?= form_error('username') ?>
                     </div>
                     <div class="form-group <?= form_error('password') ? 'has-error' : null ?>">
                         <label>Password *</label>
                         <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
                         <?php if($this->uri->segment(2)=='edit'){?>
                         <small><i>*Kosongi jika tidak ingin mengubah password</i></small>
                         <?php }?>
                         <?= form_error('password') ?>
                     </div>
                     <div class="form-group <?= form_error('passwordconf') ? 'has-error' : null ?>">
                         <label>Konfirmasi Password *</label>
                         <input type="password" name="passwordconf" class="form-control" placeholder="Masukkan Konfirmasi Password">
                         <?= form_error('passwordconf') ?>
                     </div>
                     <div class="form-group">
                         <label>Alamat</label>
                         <textarea name="address" class="form-control" placeholder="Masukkan Alamat"><?= $user->address == '' ? set_value('address') : $user->address  ?></textarea>
                     </div>
                     <div class="form-group <?= form_error('level') ? 'has-error' : null ?>">
                         <label>Level *</label>
                         <select name="level" class="form-control">
                             <option value="">- Pilih -</option>
                             <option value="1" <?= set_value('level') == 1 ? 'selected' : (($user->level == 1) ? 'selected' : null) ?>>Admin</option>
                             <option value="2" <?= set_value('level') == 2 ? 'selected' : (($user->level == 2) ? 'selected' : null) ?>>Kasir</option>
                         </select>
                         <?= form_error('level') ?>
                     </div>
                     <div class="form-group">
                         <button type="submit" class="btn btn-success btn-flat" name="<?= $page ?>">
                             <i class="fa fa-paper-plane"></i> Save</button>
                         <button type="reset" class="btn btn-flat">Reset</button>
                     </div>
                     <?php echo form_close() ?>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- /.content -->