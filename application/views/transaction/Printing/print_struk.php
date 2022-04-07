<html mozNoMarginBoxes mozDisallowSelectionPrint>

<head>
    <title>e-POS - Print Nota</title>
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
                        <?= date('d/m/Y', strtotime($printing->date)) . " " . date('H:i', strtotime($printing->printing_created)); ?></td>
                    <td>Cashier</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:right"><?= ucfirst($printing->user_name); ?></td>
                </tr>
                <tr>
                    <td> <?= $printing->invoice; ?> </td>
                    <td>Pelanggan</td>
                    <td style="text-align:center;">:</td>
                    <td style="text-align:right"><?= $printing->customer_id != null ? $printing->customer_name : "Umum" ?> </td>
                </tr>
            </table>
        </div>
        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="min-width: 130px">Brg</td>
                    <td style="width:5%">P</td>
                    <td style="width:5%">L</td>
                    <td style="text-align:right;">Hrg
                    </td>
                    <td style="text-align:right;">Total</td>
                </tr>
                <tr>
                    <td colspan="5" style="border-bottom:1px dashed; padding-top:5px;"></td>
                </tr>
                <?php $arr_discount = [];
                foreach ($printing_detail as $sd) { ?>
                    <tr>
                        <td><?= $sd->name; ?></td>
                        <td><?= $sd->p; ?></td>
                        <td><?= $sd->l; ?></td>
                        <td style="text-align: right;"><?= indo_currency($sd->price); ?></td>
                        <td style="text-align: right;width:60px;">
                            <?= indo_currency(($sd->price - $sd->discount_item) * ($sd->p*$sd->l)); ?>
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
                        <td colspan="3" style="text-align: right;">Disc. <?= $ad + 1; ?></td>
                        <td style="text-align: right;"><?= indo_currency($ad); ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="5" style="border-bottom: 1px dashed;padding-top:5px;"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td style="text-align: right; padding-top:5px;">Sub Total</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= indo_currency($printing->total_price); ?>
                    </td>
                </tr>
                <?php if ($printing->discount > 0) { ?>
                    <tr>
                        <td colspan="3"></td>
                        <td style="text-align: right; padding-top:5px;">Disc. printing</td>
                        <td style="text-align: right; padding-top:5px;">
                            <?= indo_currency($printing->discount); ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3"></td>
                    <td style="text-align: right; padding-top:5px;">Grand Total</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= indo_currency($printing->final_price); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td style="text-align: right; padding-top:5px;">Cash</td>
                    <td style="text-align: right; padding-top:5px;">
                        <?= indo_currency($printing->cash); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td style="text-align: right;">Change</td>
                    <td style="text-align: right;">
                        <?= indo_currency($printing->uang_kembalian); ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="thanks">
            ---Thank You---
            
        </div>
    </div>
</body>

</html>