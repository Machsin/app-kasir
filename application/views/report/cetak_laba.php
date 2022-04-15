<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Laba Penjualan Kotor & Bersih</title>
</head>
<style type="text/css">
    body {
        margin: 0;
        background: #CCCCCC;
        font: 12pt "Arial";
    }

    div.page {
        margin: 10px auto;
        border: solid 1px black;
        display: block;
        page-break-after: always;
        width: 209mm;
        height: 296mm;
        overflow: hidden;
        background: white;
    }

    div.landscape-parent {
        width: 296mm;
        height: 209mm;
    }

    div.landscape {
        width: 296mm;
        height: 209mm;
    }

    div.content {
        padding: 10mm;
    }

    body,
    div,
    td {
        font-size: 13px;
        font-family: Verdana;
    }

    @media print {
        body {
            background: none;
            -webkit-print-color-adjust: exact;
        }

        div.page {
            width: 209mm;
            height: 296mm;
        }

        div.landscape {
            transform: rotate(270deg) translate(-296mm, 0);
            transform-origin: 0 0;
        }

        div.portrait,
        div.landscape,
        div.page {
            margin: 0;
            padding: 0;
            border: none;
            background: none;
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
        text-align: center;
        background-color: #04AA6D;
        color: white;
    }
</style>

<body onload="window.print()">
    <div class="page landscape-parent">
        <div class="landscape">
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
                    <br>
                </div>
                <div class="body">
                    <table id="cetak" width="100%" style="font-size: small;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Harga Sales</th>
                                <th>Harga Kulakan</th>
                                <th>Harga Jual</th>
                                <th>Stok Awal</th>
                                <th>Terjual</th>
                                <th>Sisa Stok</th>
                                <th>Laba Kotor</th>
                                <th>Laba Bersih</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $jawal = 0;
                            $jterjual = 0;
                            $jsisa = 0;
                            $jkotor = 0;
                            $jbersih = 0;
                            foreach ($item->result() as $data) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data->name ?></td>
                                    <td><?= indo_currency($data->price) ?></td>
                                    <td><?= indo_currency($data->price2) ?></td>
                                    <td><?= indo_currency($data->price3) ?></td>
                                    <td>
                                        <?php
                                        $sale = $this->db->query("SELECT * FROM `tb_sale` JOIN tb_sale_detail on tb_sale.sale_id= tb_sale_detail.sale_id
                            WHERE tb_sale_detail.item_id ='$data->item_id' && date >= '$awal' && date <='$akhir';");
                                        $stokawal = 0;
                                        if ($sale->num_rows() > 0) {
                                            foreach ($sale->result() as $d) {
                                                $stokawal = $stokawal + $d->qty;
                                            }
                                        } else {
                                            $stokawal = 0;
                                        }
                                        $jawal = $jawal + ($data->stock + $stokawal);
                                        echo $data->stock + $stokawal;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $sale = $this->db->query("SELECT * FROM `tb_sale` JOIN tb_sale_detail on tb_sale.sale_id= tb_sale_detail.sale_id
                            WHERE tb_sale_detail.item_id ='$data->item_id' && date >= '$awal' && date <='$akhir';");
                                        $terjual = 0;
                                        if ($sale->num_rows() > 0) {
                                            foreach ($sale->result() as $d) {
                                                $terjual = $terjual + $d->qty;
                                            }
                                        } else {
                                            $terjual = 0;
                                        }
                                        $jterjual = $jterjual + $terjual;
                                        echo $terjual;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $jsisa = $jsisa + $data->stock;
                                        echo $data->stock;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $sale = $this->db->query("SELECT * FROM `tb_sale` JOIN tb_sale_detail on tb_sale.sale_id= tb_sale_detail.sale_id
                                WHERE tb_sale_detail.item_id ='$data->item_id' && date >= '$awal' && date <='$akhir';");
                                        $lkotor = 0;
                                        if ($sale->num_rows() > 0) {
                                            foreach ($sale->result() as $d) {
                                                $lkotor = $lkotor + $d->total;
                                            }
                                        } else {
                                            $lkotor = 0;
                                        }
                                        $jkotor = $jkotor + $lkotor;
                                        echo indo_currency($lkotor);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $hsales = $data->price * $terjual;
                                        $lbersih = $lkotor - $hsales;
                                        $jbersih = $jbersih + $lbersih;
                                        echo indo_currency($lbersih);
                                        ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <th colspan='5'>Total</th>
                                <td><?= $jawal ?></td>
                                <td><?= $jterjual ?></td>
                                <td><?= $jsisa ?></td>
                                <td><?= indo_currency($jkotor) ?></td>
                                <td><?= indo_currency($jbersih) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>