<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Stok</title>
</head>

<body>
    <div class="content">
        <div class="title" style="text-align: center">
            <b>
                <h1 style="margin-top:0px;margin-bottom:0px"><?=$setting->nama_toko?></h1>
            </b>
            <?=$setting->address?>
            <br>
            <?=$setting->phone?>
        </div>
        <div class="head">
            <table>
                <tr style="text-align: left">
                    <td width=120px>Laporan Stok</td>
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
                        <th>Tipe</th>
                        <th>Tanggal</th>
                        <th>Pengguna</th>
                        <th>Supplier</th>
                        <th>Detail</th>
                        <th>Nama Barang</th>
                        <th>Harga Beli</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($restock->result() as $key => $data) {
                    ?>
                        <tr>
                            <td style="width: 5%"><?= $no++ ?></td>
                            <td><?= $data->type ?></td>
                            <td><?= indo_date($data->date) ?></td>
                            <td><?= $data->user_name ?></td>
                            <td><?= $data->supplier_name == '' ? '-' : $data->supplier_name ?></td>
                            <td><?= $data->detail ?></td>
                            <td><?= $data->item_name ?></td>
                            <td><?= $data->price ?></td>
                            <td><?= $data->qty ?></td>
                            <td><?= indo_currency($data->total) ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th colspan="8" style="text-align: center"> Total</th>
                        <td>
                            <?php
                            $qty = 0;
                            foreach ($restock->result() as $key => $data) {
                                $qty = $qty + $data->qty;
                            }
                            echo $qty
                            ?>
                        </td>
                        <td>
                            <?php
                            $total = 0;
                            foreach ($restock->result() as $key => $data) {
                                $total = $total + $data->total;
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