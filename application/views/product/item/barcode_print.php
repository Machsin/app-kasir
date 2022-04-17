<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode Produk <?= $row->barcode ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/favicon.ico">
</head>
<style type="text/css">
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background: #CCCCCC;
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
        border: solid 1px black;
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
            <table>
                <tr>
                    <td colspan="2"><small><?= $row->name ?></small></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php
                        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
                        echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '" style="width:200px">';
                        ?>
                    </td>
                </tr>
                <tr>
                    <td><small><?= $row->barcode ?></small></td>
                    <td><small><?= indo_currency($row->price3) ?></small></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>