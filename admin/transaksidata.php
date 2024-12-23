<?php
include "header.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data penjualan
      <small>selerakasir</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Data penjualan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
    <div class="box box-primary">
      <div class="box-header">
        <a href="transaksitambah.php"  class="btn btn-primary"><i class="glyphicon glyphicon-plus">
        </i>Tambah</a>

      </div>
      <!-- /.box-header -->
      <div class="box-body ">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO</th>
              <th>TANGGAL PENJUALAN</th>
              <th>NAMA penjualan</th>
              <th>TOTAL</th>
              <th>OPSI</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <?php
              $conn = mysqli_connect("127.0.0.1:3307", "root", "", "sistemkasir");
              if (!$conn) {
                die("Koneksi database gagal: " . mysqli_connect_error());
              }
              $iduser = $_SESSION['iduser'];
              $dt_penjualan = mysqli_query($conn, "SELECT * FROM tb_penjualan
              INNER JOIN tb_pelanggan ON tb_pelanggan.idpelanggan");
              $no = 1;
              while ($penjualan = mysqli_fetch_array($dt_penjualan)) { ?>
                <td><?php echo $no++; ?></td>
                <td><?php echo $penjualan['tanggalpenjualan'];?></td>
                <td><?php echo $penjualan['nama'];?></td>
                <td><?php echo "Rp. " .number_format($penjualan['totalharga']);?></td>
                
            </tr>
          <?php
              }
          ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="tambah-penjualan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data penjualan</h4>
      </div>
      <form action="transaksitambah.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Nama penjualan</label>
            <input type="text" class="form-control" name="nama">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" class="form-control" name="alamat">
          </div>
          <div class="form-group">
            <label>Telepon</label>
            <input type="number" class="form-control" name="telepon">
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