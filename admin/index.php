<?php
include "header.php";
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>selerakasir</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-cart-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Data Menu</span>
              <span class="info-box-number">
              <?php
              // Koneksi ke database
              $conn = mysqli_connect("127.0.0.1:3307", "root", "", "sistemkasir");
              if (!$conn) {
                  die("Koneksi database gagal: " . mysqli_connect_error());
              }

              // Query untuk menghitung jumlah pelanggan
              $menu = mysqli_query($conn, "SELECT * FROM tb_menu");
              if ($menu) {
                  echo mysqli_num_rows($menu);
              } else {
                  echo "Error: " . mysqli_error($conn);
              }
              ?>
              </span>
            </div>
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Data Pelanggan</span>
              <span class="info-box-number">
              <?php
              $pelanggan = mysqli_query($conn, "SELECT * FROM tb_pelanggan");
              if ($pelanggan) {
                  echo mysqli_num_rows($pelanggan);
              } else {
                  echo "Error: " . mysqli_error($conn);
              }
              ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Data Transaksi</span>
              <span class="info-box-number"><?php
              $transaksi = mysqli_query($conn, "SELECT * FROM tb_penjualan");
              if ($transaksi) {
                  echo mysqli_num_rows($transaksi);
              } else {
                  echo "Error: " . mysqli_error($conn);
              }
              ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Transaksi</span>
              <span class ="info-box-number">
                <?php
                $total_transaksi = mysqli_query($conn, "SELECT SUM(totalharga) AS jml_total FROM tb_penjualan");
                while($t_trans = mysqli_fetch_array($total_transaksi)){ ?>
                  <?php
                    $total = +$t_trans['jml_total'];
                }
                ?>
                <?php
                echo "Rp." .number_format($total);
                ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php

include "footer.php"
?>