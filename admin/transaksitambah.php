<?php
include "header.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-transaksi"><i class="glyphicon glyphicon-plus">
            </i> Tambah</button>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-9">
                <!-- Info boxes -->
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body ">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA BARANG</th>
                                    <th>JUMLAH</th>
                                    <th>SUB TOTAL</th>
                                    <th>OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    $conn = mysqli_connect("127.0.0.1:3307", "root", "", "sistemkasir");
                                    $dt_penjualan = mysqli_query($conn, "SELECT max(idpenjualan) as idpenjualan from tb_penjualan");
                                    $penjualan = mysqli_fetch_array($dt_penjualan);
                                    $kodepenjualan = $penjualan['idpenjualan'];
                                    $urutan = (int) substr($kodepenjualan, -4, 4);
                                    $urutan++;
                                    $huruf = date('ymd');
                                    $kodeBarang = $huruf . sprintf("%04s", $urutan);
                                    $dt_jumlah = mysqli_query($conn, "SELECT *, SUM(jumlahmenu) as jumlahmenu from tb_detailpenjualan INNER JOIN tb_menu on tb_menu.idmenu = tb_detailpenjualan.idmenu where idpenjualan = '$kodeBarang' group by tb_detailpenjualan.idmenu");
                                    $no = 1;
                                    while ($penjualan = mysqli_fetch_array($dt_jumlah)) { ?>

                                        <td><?= $no++; ?></td>
                                        <td><?= $penjualan['namamenu']; ?></td>
                                        <td><?= $penjualan['jumlahmenu']; ?></td>
                                        <td><?= "Rp." . number_format($penjualan['subtotal']); ?></td>
                                        <td>
                                            <a href="#" class="btn btn-danger" role="button"
                                                title="Hapus Data"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                </tr>
                            <?php
                                    }
                            ?>
                            <tfoot>
                                <tr>
                                    <?php
                                    $PenjualanID = $kodeBarang;
                                    $ProdukID = $penjualan['idmenu'];
                                    $sub_total_belanja = mysqli_query($conn, "SELECT SUM(subtotal) AS Sub_Total FROM tb_detailpenjualan where idpenjualan = '$PenjualanID'");
                                    while ($total_belanja = mysqli_fetch_array($sub_total_belanja)) { ?>
                                    <?php
                                        $total = +$total_belanja['Sub_Total'];
                                    }
                                    ?>
                                    <td colspan="3">Total Belanja</td>
                                    <td colspan="2"><strong><?php echo "Rp. " . number_format($total) . ", -" ?></td>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.row -->
            </div>
            <form action="transaksirekap.php" method="POST">
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Total Harga</label>
                                <input type="text" name="totalharga" class="form-control" value="<?php echo $total;?>">
                                <label for="">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="<?=date('Y-m-d') ?>">
                            </div>
                            <div class="form-group">
                                <?php
                                $dt_penjualan = mysqli_query($conn, "SELECT max(idpenjualan) as idpenjualan FROM tb_penjualan");
                                ?>
                                <label for="">Nomor Transaksi</label>
                                <input type="text" name="notrans" class="form-control" value="<?php echo $kodeBarang ?>">
                            </div>
                            <div class="form-group">
                                <label for="pelanggan">Data Pelanggan</label>
                                <select name="pelanggan" id="pelanggan" class="form-control">
                                    <option value="">--Pilih pelanggan</option>
                                    <?php
                                    $conn = mysqli_connect("127.0.0.1:3307", "root", "", "sistemkasir");
                                    $dt_pelanggan = mysqli_query($conn, "SELECT * FROM tb_pelanggan");
                                    while ($pelanggan = mysqli_fetch_array($dt_pelanggan)) { ?>
                                        <option value="<?php echo $pelanggan['idpelanggan'] ?>"><?php echo $pelanggan['nama'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success pull-right">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="tambah-transaksi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Data penjualan</h4>
            </div>
            <form action="transaksiproses.php" method="POST">
                <div class="modal-body">
                    <?php
                    $conn = mysqli_connect("127.0.0.1:3307", "root", "", "sistemkasir");

                    // Ambil idpenjualan terbesar
                    $dt_penjualan = mysqli_query($conn, "SELECT MAX(idpenjualan) as idpenjualan FROM tb_penjualan");
                    if (!$dt_penjualan) {
                        die("Query gagal: " . mysqli_error($conn));
                    }

                    $penjualan = mysqli_fetch_array($dt_penjualan);
                    $kodepenjualan = $penjualan['idpenjualan'] ?? null;

                    if ($kodepenjualan) {
                        // Ambil 4 digit terakhir dari idpenjualan
                        $urutan = (int) substr($kodepenjualan, -4, 4);
                    } else {
                        $urutan = 0; // Jika belum ada data, mulai dari 0
                    }

                    $urutan++; // Tambahkan urutan
                    $huruf = date('ymd'); // Format tanggal (tahun, bulan, hari)

                    // Gabungkan tanggal dengan urutan baru
                    $kodeMenu = $huruf . sprintf("%04d", $urutan);
                    ?>

                    <div class="form-group">
                        <label>Nomor Transaksi</label>
                        <input type="text" class="form-control" name="notrans" value="<?= $kodeMenu; ?>">
                    </div>
                    <div class="form-group">
                        <label>Pilih Barang</label>
                        <select name="menu" id="menu" class="form-control">
                            <option value="">--Pilih Produk</option>
                            <?php
                            $dt_menu = mysqli_query($conn, "SELECT * FROM tb_menu");
                            while ($menu = mysqli_fetch_array($dt_menu)) { ?>
                                <option value="<?php echo $menu['idmenu']; ?>"><?php echo $menu['namamenu'] . "(" . $menu['stok'] . ")"; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php

include "footer.php"
?>