<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="<?= $this->uri->segment('1') == 'dashboard' ? 'active' : null ?>">
        <a href="<?= base_url('dashboard') ?> "><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <li class="<?= $this->uri->segment('1') == 'supplier' ? 'active' : null ?>">
        <a href="<?= base_url('supplier') ?>"><i class="fa fa-truck"></i> <span>Pemasok</span></a>
    </li>
    <li class="<?= $this->uri->segment('1') == 'customer' ? 'active' : null ?>">
        <a href="<?= base_url('customer') ?>"><i class="fa fa-users"></i> <span>Pelanggan</span></a>
    </li>
    <li class="treeview <?= $this->uri->segment('1') == 'categori' ||
                            $this->uri->segment('1') == 'unit' ||
                            $this->uri->segment('1') == 'item' ? 'active' : null ?>">
        <a href="#">
            <i class="fa fa-archive"></i> <span>Produk</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li class="<?= $this->uri->segment('1') == 'categori' ? 'active' : null ?>"><a href="<?= base_url('categori') ?>"><i class="fa fa-circle-o"></i> Kategori</a></li>
            <li class="<?= $this->uri->segment('1') == 'unit' ? 'active' : null ?>"><a href="<?= base_url('unit') ?>"><i class="fa fa-circle-o"></i> Unit</a></li>
            <li class="<?= $this->uri->segment('1') == 'item' ? 'active' : null ?>"><a href="<?= base_url('item') ?>"><i class="fa fa-circle-o"></i> Barang</a></li>
        </ul>
    </li>
    <li class="treeview <?= $this->uri->segment('1') == 'sale' ||
                            $this->uri->segment('1') == 'stock' ? 'active' : null ?>">
        <a href="#">
            <i class="fa fa-shopping-cart"></i> <span>Transaksi</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li class="<?=$this->uri->segment('1')=='sale'?'active':null?>"><a href="<?= base_url('sale') ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li class="<?=$this->uri->segment('2')=='in'?'active':null?>"><a href="<?= base_url('stock/in') ?>"><i class="fa fa-circle-o"></i> Stok Masuk</a></li>
            <li class="<?=$this->uri->segment('2')=='out'?'active':null?>"><a href="<?= base_url('stock/out') ?>"><i class="fa fa-circle-o"></i> Stok Keluar</a></li>
        </ul>
    </li>
    <li class="treeview <?= $this->uri->segment('1') == 'report' ? 'active' : null ?>">
        <a href="#">
            <i class="fa fa-pie-chart"></i> <span>Laporan</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
            <li class="<?=$this->uri->segment('2')=='report_sale'?'active':null?>"><a href="<?= base_url('report/report_sale') ?>"><i class="fa fa-circle-o"></i> Penjualan</a></li>
            <li class="<?=$this->uri->segment('2')=='report_stock'?'active':null?>"><a href="<?= base_url('report/report_stock') ?>"><i class="fa fa-circle-o"></i> Stok</a></li>
            <li class="<?=$this->uri->segment('2')=='report_laba'?'active':null?>"><a href="<?= base_url('report/report_laba') ?>"><i class="fa fa-circle-o"></i> Laba Kotor & Bersih</a></li>
        </ul>
    </li>
    <?php if ($this->session->userdata('level') == 1) { ?>
        <li class="header">SETTINGS</li>
        <li class="<?= $this->uri->segment('1') == 'user' ? 'active' : null ?>"><a href="<?= base_url('user') ?>"><i class="fa fa-user"></i> <span>Pengguna</span></a></li>
        <li class="<?= $this->uri->segment('1') == 'setting' ? 'active' : null ?>"><a href="<?= base_url('setting') ?>"><i class="fa fa-cogs"></i> <span>Pengaturan</span></a></li>
        <li class="<?= $this->uri->segment('1') == 'backup' ? 'active' : null ?>"><a href="<?= base_url('backup') ?>"><i class="fa fa-database"></i> <span>Backup & Restore Data</span></a></li>
    <?php } ?>
</ul>