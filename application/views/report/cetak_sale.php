<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Penjualan</title>
</head>

<body>
    <div class="content">
        <div class="title" style="text-align: center">
            <b>
                <h1 style="margin-top:0px;margin-bottom:0px"><?= $setting->nama_toko ?></h1>
            </b>
            <?= $setting->address ?>
            <br>
            <?= $setting->phone ?>
        </div>
        <div class="head">
            <table>
                <tr style="text-align: left">
                    <td width=150px>Laporan Penjualan</td>
                    <td>:</td>
                    <td><?= $date ?></td>
                </tr>
                <tr style="text-align: left">
                    <td>Tanggal Cetak</td>
                    <td>:</td>
                    <td><?php echo date('d-m-Y') ?></td>
                </tr>
            </table>
        </div>
        <div class="body">
            <table border="1" width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Total Harga</th>
                        <th>Diskon</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($resale->result() as $key => $data) {
                    ?>
                        <tr>
                            <td style="width: 5%"><?= $no++ ?></td>
                            <td><?= $data->invoice ?></td>
                            <td><?= indo_date($data->date) ?></td>
                            <td><?= $data->customer_name == '' ? 'Umum' : $data->customer_name ?></td>
                            <td><?= indo_currency($data->total_price) ?></td>
                            <td><?= $data->discount ?></td>
                            <td><?= indo_currency($data->final_price) ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th colspan="6" style="text-align: center"> Total</th>
                        <td>
                            <?php
                            $total = 0;
                            foreach ($resale->result() as $key => $data) {
                                $total = $total + $data->final_price;
                            }
                            echo indo_currency($total)
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>