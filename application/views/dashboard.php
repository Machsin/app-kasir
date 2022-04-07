<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Dashboard
		<small>Control Panel</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i></a></li>
		<li class="active">Dashboard</li>
	</ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-aqua"><i class="fa fa-th"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Barang</span>
					<span class="info-box-number"><?= $item ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-red"><i class="fa fa-truck"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Pemasok</span>
					<span class="info-box-number"><?= $supplier ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Pelanggan</span>
					<span class="info-box-number"><?= $customer ?></span>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box">
				<span class="info-box-icon bg-yellow"><i class="fa fa-user-plus"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">Pengguna</span>
					<span class="info-box-number"><?=$user?></span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<!-- BAR CHART -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					<div class="chart">
						<canvas id="myChart4" height="320px"></canvas>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
		<div class="col-xs-12 col-md-12">
			<!-- BAR CHART -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
						</button>
					</div>
				</div>
				<div class="box-body">
					<div class="chart">
						<canvas id="myChart2" height="320px"></canvas>
					</div>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>
<!-- /.content -->
<!-- ChartJS -->
<script src="<?= base_url('') ?>/assets/bower_components/Chart.js-2.9.4/dist/Chart.min.js"></script>
<script>
	
	var namabulan = ("Kosong Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
	namabulan = namabulan.split(" ");
	var bulan = parseInt(<?= date('m') ?>);
	var tahun = <?= date('Y') ?>;
	var ctx = document.getElementById('myChart2').getContext('2d');
	var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'bar',

		// The data for our dataset
		data: {
			labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
			datasets: [{
					label: 'Penjualan (Pendapatan Bulanan Tahun ' + tahun + ')',
					backgroundColor: 'rgb(60,141,188)',
					data: [
						<?= $januari ?>,
						<?= $februari ?>,
						<?= $maret ?>,
						<?= $april ?>,
						<?= $mei ?>,
						<?= $juni ?>,
						<?= $juli ?>,
						<?= $agustus ?>,
						<?= $september ?>,
						<?= $oktober ?>,
						<?= $november ?>,
						<?= $desember ?>,
					]
				}

			]
		},
		// Configuration options go here
		options: {
			tooltips: {
				callbacks: {
					label: function(tooltipItem, data) {
						return "Rp. " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
							return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
						});
					}
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						suggestedMin: 0,
						stepSize: 50000,
						callback: function(label, index, labels) {
							// return label/1000+'k'; 
							return "Rp. " + Intl.NumberFormat().format(label);
						}

					}
				}]
			}
		}
	});
	var ctx = document.getElementById('myChart4').getContext('2d');
	var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'bar',
		// The data for our dataset
		data: {
			labels: [
				<?php
				for ($i = 1; $i <= 31; $i++) {
					echo $i . ',';
				}
				?>
			],
			datasets: [{
					label: 'Penjualan (Pendapatan Harian Bulan ' + namabulan[bulan] + ' Tahun ' + tahun + ')',
					backgroundColor: 'rgb(60,141,188)',
					data: [
						<?= $hari1 ?>, <?= $hari2 ?>, <?= $hari3 ?>, <?= $hari4 ?>, <?= $hari5 ?>, <?= $hari6 ?>, <?= $hari7 ?>, <?= $hari8 ?>, <?= $hari9 ?>, <?= $hari10 ?>,<?= $hari11 ?>, <?= $hari12 ?>, <?= $hari13 ?>, <?= $hari14 ?>, <?= $hari15 ?>, <?= $hari16 ?>, <?= $hari17 ?>, <?= $hari18 ?>, <?= $hari19 ?>, <?= $hari20 ?>,<?= $hari21 ?>, <?= $hari22 ?>, <?= $hari23 ?>, <?= $hari24 ?>, <?= $hari25 ?>, <?= $hari26 ?>, <?= $hari27 ?>, <?= $hari28 ?>, <?= $hari29 ?>, <?= $hari30 ?>, <?= $hari31 ?>
					]
				}

			]
		},
		// Configuration options go here
		options: {
			tooltips: {
				callbacks: {
					label: function(tooltipItem, data) {
						return "Rp. " + Number(tooltipItem.yLabel).toFixed(0).replace(/./g, function(c, i, a) {
							return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "." + c : c;
						});
					}
				}
			},
			scales: {
				yAxes: [{
					ticks: {
						suggestedMin: 0,
						stepSize: 50000,
						callback: function(label, index, labels) {
							// return label/1000+'k'; 
							return "Rp. " + Intl.NumberFormat().format(label);
						}

					}
				}]
			}
		}
	});
</script>