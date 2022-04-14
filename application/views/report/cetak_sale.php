<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Penjualan</title>
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
            <br>
        </div>
        <div class="body">
            <table id="cetak" width="100%">
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
    </div>
</body>

</html>