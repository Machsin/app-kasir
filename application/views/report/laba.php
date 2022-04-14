<section class="content-header">
     <h1>
         Data Laporan Laba Penjualan Kotor & Bersih
         <small>Reports Sales</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-pie-chart"></i></a></li>
         <li class="active">Data Laporan Laba Penjualan Kotor & Bersih</li>
     </ol>
 </section>
 <!-- Main content -->
 <section class="content">
     <?php $this->view('message') ?>
     <div class="container-fluid">
         <div class="row">
             <div class="box box-primary">
                 <div class="box-header" style="padding-bottom:5px; padding-top:5px;">
                     <h4 class="m-0">Data Laporan Laba Penjualan Kotor & Bersih</h4>
                 </div>
                 <div class="box-body row" style="padding-top:0">
                     <form action="<?= base_url('report/report_laba') ?>" method="POST">
                         <div class="col-md-3 col-xs-12">
                             <div class="form-group">
                                 <label for="bulan">Bulan</label>
                                 <select class="form-control" name="bln">
                                     <option value="01" <?php if ($bln == '01') {
                                                            echo 'selected';
                                                        } ?>>Januari</option>
                                     <option value="02" <?php if ($bln == '02') {
                                                            echo 'selected';
                                                        } ?>>Februari</option>
                                     <option value="03" <?php if ($bln == '03') {
                                                            echo 'selected';
                                                        } ?>>Maret</option>
                                     <option value="04" <?php if ($bln == '04') {
                                                            echo 'selected';
                                                        } ?>>April</option>
                                     <option value="05" <?php if ($bln == '05') {
                                                            echo 'selected';
                                                        } ?>>Mei</option>
                                     <option value="06" <?php if ($bln == '06') {
                                                            echo 'selected';
                                                        } ?>>Juni</option>
                                     <option value="07" <?php if ($bln == '07') {
                                                            echo 'selected';
                                                        } ?>>Juli</option>
                                     <option value="08" <?php if ($bln == '08') {
                                                            echo 'selected';
                                                        } ?>>Agustus</option>
                                     <option value="09" <?php if ($bln == '09') {
                                                            echo 'selected';
                                                        } ?>>September</option>
                                     <option value="10" <?php if ($bln == '10') {
                                                            echo 'selected';
                                                        } ?>>Oktober</option>
                                     <option value="11" <?php if ($bln == '11') {
                                                            echo 'selected';
                                                        } ?>>November</option>
                                     <option value="12" <?php if ($bln == '12') {
                                                            echo 'selected';
                                                        } ?>>Desember</option>
                                 </select>
                             </div>
                         </div>

                         <div class="col-md-3 col-xs-12">
                             <div class="form-group">
                                 <label for="tahun">Tahun</label>
                                 <select class="form-control" name="thn">
                                     <?php for ($i = 2016; $i <= 2035; $i++) { ?>
                                         <option value="<?= $i; ?>" <?php if ($thn == $i) {
                                                                        echo 'selected';
                                                                    } ?>>
                                             <?= $i; ?>
                                         </option>
                                     <?php } ?>
                                 </select>
                             </div>
                         </div>

                         <div class="col-md-12 col-xs-12 ">
                             <button type="submit" name="cetak" value="cetak" id="cetak" class="btn btn-success btn-xs" onclick="$('form').attr('target', '_blank');">
                                 <i class="fa fa-print"></i>
                                 Cetak
                             </button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- /.content -->