<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Penjualan
        <small>Sales</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li>Transaksi</li>
        <li class="active">Penjualan</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <!-- Tanggal -->
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="date">Tanggal</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="date" id="date" value="<?= date('Y-m-d') ?>" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="user">Kasir</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="user" value="<?= $this->session->userdata('name') ?>" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="customer">Pelanggan</label>
                            </td>
                            <td>
                                <div>
                                    <select id="customer_id" class="form-control">
                                        <option value="">Umum</option>
                                        <?php foreach ($customer->result() as $i => $data) { ?>
                                            <option value="<?= $data->customer_id ?>"><?= $data->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <!-- Barang -->
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:35%">
                                <label for="barcode">Barcode</label>
                            </td>
                            <td>
                                <div class="form-group input-group">
                                    <input type="hidden" id="item_id">
                                    <input type="hidden" id="price">
                                    <input type="hidden" id="stock">
                                    <input type="text" id="barcode" class="form-control" autofocus>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                                            <i class="fa fa-search" id="basic"></i>
                                        </button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="barang">Barang</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" id="item_name" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="qty">Qty</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="qty" value="1" min="1" class="form-control">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <div>
                                    <button type="button" id="add_cart" class="btn btn-primary">
                                        <i class="fa fa-cart-plus"></i> Tambah
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="box box-widget">
                <div class="box-body">
                    <div align="right">
                        <h4>Invoice <b><span id="invoice"><?= $invoice ?></span></b></h4>
                        <h1><b><span id="grand_total2" style="font-size:50pt">Rp. 0</span></b></h1>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-widget">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Barcode</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th width="10%">Diskon Barang</th>
                                <th width="15%">Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cart_tabel">
                            <?php $this->view('transaction/sale/cart_data') ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="sub_total">Total Awal</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="sub_total" value="" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="discount">Diskon</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="discount" min="0" class="form-control" placeholder="0">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align:top">
                                <label for="grand_total">Total Akhir</label>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" id="grand_total" class="form-control" readonly>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <tr>
                            <td style="vertical-align:top; width:30%">
                                <label for="cash" style="font-size: 20pt;">Bayar</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="number" placeholder="0" id="cash" min="0" class="form-control" style="font-size: 30px;height: 85px;" onkeypress="return nextfield(event)">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="box box-widget">
                <div class="box-body">
                    <table width="100%">
                        <!-- <tr>
                            <td style="vertical-align:top">
                                <label for="note">Catatan</label>
                            </td>
                            <td>
                                <div>
                                    <textarea id="note" rows="3" class="form-control"></textarea>
                                </div>
                            </td>
                        </tr> -->
                        <tr>
                            <td style="vertical-align:top">
                                <label for="change" style="font-size: 20pt;">Kembalian</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="hidden" id="note" rows="3" class="form-control"></input>
                                    <input type="hidden" id="change" class="form-control" readonly style="font-size: 30px;height: 85px;">
                                    <input type="text" id="kembalian" class="form-control" readonly style="font-size: 30px;height: 85px;">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div>
                <button id="cancel_payment" class="btn btn-flat btn-warning">
                    <i class="fa fa-refresh"></i> Cancel
                </button><br><br>
                <button id="process_payment" class="btn btn-flat btn-lg btn-success">
                    <i class="fa fa-paper-plane-o"></i> Proses Pembayaran
                </button>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal-item">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Daftar Data Barang</h4>
            </div>
            <div class="modal-body table-responsive">
                <div class="container-fluid">
                    <table class="table table-bordered table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Nama Barang</th>
                                <th>Unit</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($item->result() as $i) { ?>
                                <tr>
                                    <td><?= $i->barcode; ?></td>
                                    <td><?= $i->name; ?></td>
                                    <td style="text-align: center;"><?= $i->unit_name; ?></td>
                                    <?php if ($setting->kategori_harga == 'kulakan') { ?>
                                        <td style="text-align: center;"><?= indo_currency($i->price2); ?></td>
                                    <?php } else { ?>
                                        <td style="text-align: center;"><?= indo_currency($i->price3); ?></td>
                                    <?php } ?>
                                    <td><?= $i->stock; ?></td>
                                    <td align="center">
                                        <button class="btn btn-xs btn-info" id="select" data-id="<?= $i->item_id; ?>" data-item_name="<?= $i->name; ?>" data-barcode="<?= $i->barcode; ?>" data-price="<?= $i->price; ?>" data-stock="<?= $i->stock; ?>">
                                            <i class="fa fa-check"></i> Select
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        calculate()
    });

    $(document).on('click', '#select', function() {
        $('#item_id').val($(this).data('id'))
        $('#item_name').val($(this).data('item_name'))
        $('#barcode').val($(this).data('barcode'))
        $('#price').val($(this).data('price'))
        $('#stock').val($(this).data('stock'))
        $('#modal-item').modal('hide')
    });

    $(document).on('click', '#add_cart', function() {
        var item_id = $('#item_id').val();
        var price = $('#price').val();
        var stock = $('#stock').val();
        var qty = $('#qty').val();
        if (item_id == '') {
            alert('Barang belum dipilih');
            $('#barcode').focus();
        } else if (stock - qty < 0) {
            alert('Stock tidak mencukupi');
            $('#item_id').val('');
            $('#barcode').val('');
            $('#barcode').focus();
        } else {
            $.ajax({
                type: "POST",
                url: "<?= base_url('sale/process') ?>",
                data: {
                    'add_cart': true,
                    'item_id': item_id,
                    'price': price,
                    'qty': qty
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_tabel').load('<?= base_url('sale/cart_data'); ?>', function() {
                            calculate()
                        });
                        $('#item_id').val('');
                        $('#barcode').val('');
                        $('#qty').val(1);
                        $('#barcode').focus();
                    } else {
                        alert('Gagal tambah item cart');
                    }
                }
            });
        }
    })

    $(document).on('click', '#del_cart', function() {
        if (confirm('apakah anda yakin?')) {
            var cart_id = $(this).data('cartid');
            $.ajax({
                type: "POST",
                url: "<?= base_url('sale/cart_del') ?>",
                data: {
                    'cart_id': cart_id
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_tabel').load('<?= base_url('sale/cart_data'); ?>', function() {

                        });
                    } else {
                        alert('Gagal hapus item cart');
                    }
                }
            });

        }
    });

    $(document).on('click', '#process_payment', function() {
        process_payment();
    });

    $(document).on('click', '#cancel_payment', function() {
        if (confirm('Ingin membatalkan pesanan?')) {
            $.ajax({
                type: "POST",
                url: "<?= base_url('sale/reset') ?>",
                data: {
                    'cancel_payment': true
                },
                dataType: "json",
                success: function(result) {
                    if (result.success == true) {
                        console.log('terhapus')
                        $('#cart_tabel').load('<?= base_url('sale/cart_data'); ?>', function() {
                            calculate()
                        });
                    }
                }
            })
            $('#discount').val(0)
            $('#cash').val(0)
            $('#customer').val('').change()
            $('#barcode').val('')
            $('#barcode').focus()

        }
    });

    function calculate() {
        var subtotal = 0;
        $('#cart_tabel tr').each(function() {
            subtotal += parseInt($(this).find('#total').text(), 10)
        })
        isNaN(subtotal) ? $('#sub_total').val(0) : $('#sub_total').val(subtotal)

        var discount = $('#discount').val()
        var grand_total = subtotal - discount
        //console.log(subtotal);
        if (isNaN(grand_total)) {
            $('#grand_total').val(0)
            $('#grand_total2').text('Rp. 0')
        } else {
            $('#grand_total').val(grand_total)
            var total_angka = grand_total + '';
            $('#grand_total2').text(formatRupiah(total_angka, 'Rp. '))
        }

        //hitung kembalian
        var cash = $('#cash').val();
        cash != 0 ? $('#change').val(cash - grand_total) : $('#change').val(0);
        cash != 0 ? $('#kembalian').val(formatRupiah('' + (cash - grand_total), 'Rp. ')) : $('#kembalian').val(0);
    }

    $(document).on('keyup mouseup', '#discount, #cash', function() {
        calculate()
    })
    $(document).on('change', '#barcode', function() {
        var item_id = $('#barcode').val();
        $.ajax({
            type: "POST",
            url: "<?= base_url('item/getitem') ?>",
            data: {
                'add_item': true,
                'item_id': item_id,
            },
            dataType: "json",
            success: function(result) {
                if (result.success == true) {
                    if(result.stock - 1 < 0){
                        alert('Stock tidak mencukupi');
                        $('#item_id').val('');
                        $('#barcode').val('');
                        $('#barcode').focus();
                    }else{
                    $('#item_id').val(result.item_id);
                    $('#item_name').val(result.item_name);
                    $('#unit_name').val(result.unit_name);
                    $('#stock').val(result.stock);
                    $('#price').val(result.price);
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('sale/process') ?>",
                        data: {
                            'add_cart': true,
                            'item_id': result.item_id,
                            'price': result.price,
                            'qty': '1'
                        },
                        dataType: "json",
                        success: function(result) {
                            if (result.success == true) {
                                $('#cart_tabel').load('<?= base_url('sale/cart_data'); ?>', function() {
                                    calculate()
                                });
                                $('#item_id').val('');
                                $('#barcode').val('');
                                $('#qty').val(1);
                                $('#barcode').focus();
                            } else {
                                alert('Gagal tambah item cart');
                            }
                        }
                    })
                    };
                } else {
                    alert('Barang tidak ada');
                    $('#item_id').val('');
                    $('#barcode').val('');
                    $('#item_name').val('');
                    $('#unit_name').val('');
                    $('#stock').val('');
                    $('#price').val('');
                }
            }
        });
    });
    function nextfield(event){
	    if(event.keyCode == 13 || event.which == 13){
	    process_payment();
    	}
    }
    function process_payment(){
        var subtotal = $('#sub_total').val();
        var customer = $('#customer_id').val();
        var discount = $('#discount').val();
        var grandtotal = $('#grand_total').val();
        var cash = $('#cash').val();
        var change = $('#change').val();
        var note = $('#note').val();
        var date = $('#date').val();

        if (subtotal < 1) {
            alert('Product belum dipilih');
            $('#barcode').focus();
        } else if (cash < 1) {
            alert('Masukkan Uang Cash');
            $('#cash').focus();
        } else {
            if (confirm('Ingin memproses transaksi ini?')) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('sale/process') ?>",
                    data: {
                        'process_payment': true,
                        'customer_id': customer,
                        'sub_total': subtotal,
                        'discount': discount,
                        'grand_total': grandtotal,
                        'cash': cash,
                        'change': change,
                        'note': note,
                        'date': date
                    },
                    dataType: "json",
                    success: function(result) {
                        if (result.success == true) {
                            console.log('Print.......')
                            alert('Berhasil melakukan transaksi')
                            if (confirm('Ingin mencetak nota')) {
                                window.open('<?= base_url('sale/cetak/') ?>' + result.sale_id,
                                    '_blank')
                                window.location.reload();
                            } else {
                                window.location.reload();
                            }
                        } else {
                            alert('gagal melakukan transaksi');
                            console.log('gagal.......')
                        }
                    }
                });
            }
        }
    }
    //fungsi formatrupiah
    function formatRupiah(angka, prefix) {
        var minus = angka.charAt(0);
        if (minus == '-') {
            minus = '-';
        } else {
            minus = '';
        }
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? minus + rupiah : (minus + rupiah ? 'Rp. ' + minus + rupiah : '');
    }
</script>