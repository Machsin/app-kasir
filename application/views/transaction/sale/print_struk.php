<html mozNoMarginBoxes mozDisallowSelectionPrint>

<head>
    <title>Print Nota</title>
<link rel="shortcut icon" href="<?= base_url() ?>assets/favicon.ico">
    <style typa="text/css">
        html {
            font-family: "verdana, arial";
        }

        .content {
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 5px;
            padding-bottom: 10px;
            border-bottom: 1px dashed;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        .thanks {
            padding-top: 10px;
            font-size: 11px;
            text-align: center;
            border-top: 1px dashed;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }

        table tr td {
            vertical-align: text-top;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="content">
        <div class="title">
            <b><?=$setting->nama_toko?></b>
            <br>
            Alamat : <?=$setting->address?>
            <br>
            Telp : <?=$setting->phone?>
        </div>

        <div class="head">
            <table cellspacong="0" cellpadding="0">
                <tr>
                    <td style="width:120px">
                        <?= date('d/m/Y', strtotime($sale->date)) . " " . date('H:i', strtotime($sale->sale_created)); ?></td>
                    <td>Kasir</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:right"><?= ucfirst($sale->user_name); ?></td>
                </tr>
                <tr>
                    <td> <?= $sale->invoice; ?> </td>
                    <td>Pelanggan</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:right"><?= $sale->customer_id != null ? $sale->customer_name : "Umum" ?> </td>
                </tr>
            </table>
        </div>
        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="min-width: 130px">Brg</td>
                    <td>Jml</td>
                    <td style="text-align:right;">Hrg
                    </td>
                    <td style="text-align:right;">Total</td>
                </tr>
                <tr>
                    <td colspan="4" style="border-bottom:1px dashed; padding-top:5px;"></td>
                </tr>
                <?php $arr_discount = [];
                foreach ($sale_detail as $sd) { ?>
                    <tr>
                        <td><?= $sd->name; ?></td>
                        <td style="text-align:right;"><?= $sd->qty; ?></td>
                        <td style="text-align: right;"><?= indo_currency($sd->price); ?></td>
                        <td style="text-align: right;width:60px;">
                            <?= indo_currency(($sd->price - $sd->discount_item) * $sd->qty); ?>
                        </td>
                    </tr>
                    <?php
                    if ($sd->discount_item > 0) {
                        $arr_discount[] = $sd->discount_item;
                    }
                }
                foreach ($arr_discount as $ad) { ?>
                    <tr>
                        <td></td>
                        <td colspan="2" style="text-align: right;">Disk. <?= $ad + 1; ?></td>
                        <td style="text-align: right;"><?= indo_currency($ad); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" style="border-bottom: 1px dashed;padding-top:5px;"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-top:5px;">Total Awal</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= indo_currency($sale->total_price); ?>
                    </td>
                </tr>
                <?php if ($sale->discount > 0) { ?>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align: right; padding-top:5px;">Diskon Penjualan</td>
                        <td style="text-align: right; padding-top:5px;">
                            <?= indo_currency($sale->discount); ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-top:5px;">Total Akhir</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= indo_currency($sale->final_price); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-top:5px;">Bayar</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= indo_currency($sale->cash); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right;">Kembalian</td>
                    <td style="text-align: right;">
                        <?= indo_currency($sale->uang_kembalian); ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="thanks">
            ---Terima Kasih---
            
        </div>
    </div>
</body>

</html>