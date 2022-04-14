<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Stok</title>
</head>
<style type="text/css">
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FFFF;
        font: 12pt "Arial";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 7mm;
        margin: 3mm auto;
        border: 1px #FFF solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }


    @page {
        size: A4;
        margin: 0;
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
            -webkit-print-color-adjust: exact;
        }

        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }

    }

    #cetak {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    #cetak td,
    #cetak th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #cetak tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    #cetak tr:hover {
        background-color: #ddd;
    }

    #cetak th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #04AA6D;
        color: white;
    }
</style>
<body onload="window.print()">
    <div class="book">
        <div class="page">
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
            <table id="cetak" width="100%" style="font-size: small;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tipe</th>
                        <th>Pengguna</th>
                        <th>Supplier</th>
                        <th>Detail</th>
                        <th>Nama Barang</th>
                        <th>Harga Sales </th>
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
                        <th colspan="7" style="text-align: center"> Total</th>
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
    </div>
</body>

</html>