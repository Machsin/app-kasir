<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QRCode Produk <?= $row->barcode ?></title>
<link rel="shortcut icon" href="<?= base_url() ?>assets/favicon.ico">
</head>

<body onload="window.print()">
    <?php
    $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
    echo '<img src="'. base_url('assets/image/qrcode/item-'.$row->barcode.'.png').'" style="width:200px">';
    ?>
    <br>
    <?= $row->barcode ?>
</body>

</html>