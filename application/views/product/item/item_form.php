 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Data Barang
         <small>Items Data</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-user"></i></a></li>
         <li class="active">Data Barang</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
 <?php $this->view('message') ?>
     <div class="box">
         <div class="box-header">
             <h3 class="box-title"><?= ucfirst($page) ?> Data Barang</h3>
             <div class="pull-right">
                 <a href="<?= base_url('item') ?>" class="btn btn-warning btn-flat">
                     <i class="fa fa-undo"></i> Kembali
                 </a>
             </div>
         </div>
         <div class="box-body table-responsive">
             <div class="categori">
                 <div class="col-md-4 col-md-offset-4">
                     <?php echo form_open_multipart('item/process') ?>
                     <!-- <?= validation_errors() ?> -->
                     <input type="hidden" name="item_id" value="<?= $item->item_id ?>"> 
                     <input type="hidden" name="image" value="<?= $item->image ?>">
                     <div class="form-group <?= form_error('barcode') ? 'has-error' : null ?>">
                         <label>Barcode *</label>
                         <input type="text" name="barcode" value="<?= $item->barcode == '' ? set_value('barcode') : $item->barcode  ?>" class="form-control">
                         <?= form_error('barcode') ?>
                     </div>
                     <div class="form-group <?= form_error('name') ? 'has-error' : null ?>">
                         <label>Nama *</label>
                         <input type="text" name="name" value="<?= $item->name == '' ? set_value('name') : $item->name  ?>" class="form-control">
                         <?= form_error('name') ?>
                     </div>
                     <div class="form-group  <?= form_error('categori') ? 'has-error' : null ?>">
                         <label>Kategori *</label>
                         <select name="categori" class="form-control">
                             <option value="">- Pilih -</option>
                             <?php foreach ($categori->result() as $key => $data) { ?>
                                 <option value="<?= $data->categori_id ?>" <?= $data->categori_id == $item->categori_id ? 'selected' : null ?>><?= $data->name ?></option>
                             <?php }; ?>
                         </select>
                         <?= form_error('categori') ?>
                     </div>
                     <div class="form-group <?= form_error('unit') ? 'has-error' : null ?>">
                         <label>Satuan *</label>
                         <select name="unit" class="form-control">
                             <option value="">- Pilih -</option>
                             <?php foreach ($unit->result() as $key => $data) { ?>
                                 <option value="<?= $data->unit_id ?>" <?= $data->unit_id == $item->unit_id ? 'selected' : null ?>><?= $data->name ?></option>
                             <?php }; ?>
                         </select>
                         <?= form_error('unit') ?>
                     </div>
                     <div class="form-group <?= form_error('price') ? 'has-error' : null ?>">
                         <label>Harga Jual *</label>
                         <input type="number" name="price" value="<?= $item->price == '' ? set_value('price') : $item->price  ?>" class="form-control">
                         <?= form_error('price') ?>
                     </div>
                     <div class="form-group" style="display: none;">
                         <label>Gambar</label>
                         <input type="file" name="image" class="form-control">
                         <?= form_error('item_name') ?>
                     </div>
                     <div class="form-group">
                         <button type="submit" name="<?= $page ?>" class="btn btn-success btn-flat">
                             <i class="fa fa-paper-plane"></i> Save</button>
                         <button type="reset" class="btn btn-flat">Reset</button>
                     </div>
                     <?php echo form_close()?>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- /.content -->