 <!-- Content Header (Page header) -->
 <section class="content-header">
     <h1>
         Cek Ip Address
         <small>Ip Address check</small>
     </h1>
     <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-user"></i></a></li>
         <li class="active">Cek Ip Address</li>
     </ol>
 </section>

 <!-- Main content -->
 <section class="content">
     <?php $this->view('message') ?>
     <div class="box">
         <div class="box-header">
             <h3 class="box-title">Cek Ip Address</h3>
         </div>
         <div class="box-body table-responsive">
             <?php
                $localIP = getHostByName(getHostName());
                echo "<h2 align=\"center\">Your IP Address " . $localIP . "";
                ?>
         </div>
     </div>
 </section>
 <!-- /.content -->