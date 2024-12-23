<?php
include "header.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Menu
      <small>selerakasir</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Data Menu</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
    <div class="box box-primary">
      <div class="box-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-menu"><i class="glyphicon glyphicon-plus">
          </i> Tambah</button>
      </div>
      <!-- /.box-header -->
      <div class="box-body ">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO</th>
              <th>NAMA MENU</th>
              <th>HARGA</th>
              <th>STOK</th>
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

              $dt_menu = mysqli_query($conn, "SELECT * FROM tb_menu");
              $no = 1;
              while ($menu = mysqli_fetch_array($dt_menu)) { ?>
                <td><?php echo $no++; ?></td>
                <td><?php echo $menu['namamenu'] ?></td>
                <td><?php echo "Rp. " . number_format($menu['harga']) ?></td>
                <td><?php echo $menu['stok'] ?></td>
                <td>
                  <button type="button" class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#edit-menu<?php echo $menu['idmenu']; ?>">
                    <i class="glyphicon glyphicon-edit"></i>
                  </button>
                  <div class="modal fade" id="edit-menu<?php echo $menu['idmenu'];?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Data Menu</h4>
                        </div>
                        <form action="menuedit.php" method="POST">
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Nama Menu</label>
                              <input type="hidden" class="form-control" name="idmenu" value="<?php echo $menu['idmenu'];?>">
                              <input type="text" class="form-control" name="namamenu" value="<?php echo $menu['namamenu'];?>">
                            </div>
                            <div class="form-group">
                              <label>Harga</label>
                              <input type="text" class="form-control" name="harga" value="<?php echo $menu['harga'];?>">
                            </div>
                            <div class="form-group">
                              <label>Stok</label>
                              <input type="number" class="form-control" name="stok" value="<?php echo $menu['stok'];?>">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                          </div>
                        </form>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                  <a href="menuhapus.php?idmenu=<?php echo $menu['idmenu'];?>" class="btn btn-danger" role="button" title="hapus"><i class="glyphicon glyphicon-trash"></i></a>
                </td>
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
<div class="modal fade" id="tambah-menu">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data menu</h4>
      </div>
      <form action="menutambah.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Nama menu</label>
            <input type="text" class="form-control" name="namamenu">
          </div>
          <div class="form-group">Harga</label>
            <input type="text" class="form-control" name="harga">
          </div>
          <div class="form-group">
            <label>Stok</label>
            <input type="number" class="form-control" name="stok">
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