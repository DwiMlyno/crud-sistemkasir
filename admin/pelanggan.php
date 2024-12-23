<?php
include "header.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Pelanggan
      <small>selerakasir</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Data Pelanggan</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
    <div class="box box-primary">
      <div class="box-header">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-pelanggan"><i class="glyphicon glyphicon-plus">
          </i> Tambah</button>
      </div>
      <!-- /.box-header -->
      <div class="box-body ">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>NO</th>
              <th>NAMA PELANGGAN</th>
              <th>ALAMAT</th>
              <th>TELEPON</th>
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

              $dt_pelanggan = mysqli_query($conn, "SELECT * FROM tb_pelanggan");
              $no = 1;
              while ($pelanggan = mysqli_fetch_array($dt_pelanggan)) { ?>
                <td><?php echo $no++; ?></td>
                <td><?php echo $pelanggan['nama'] ?></td>
                <td><?php echo $pelanggan['alamat'] ?></td>
                <td><?php echo $pelanggan['telepon'] ?></td>
                <td>
                  <button type="button" class="btn btn-warning" title="Edit" data-toggle="modal" data-target="#edit-pelanggan<?php echo $pelanggan['idpelanggan']; ?>">
                    <i class="glyphicon glyphicon-edit"></i>
                  </button>
                  <div class="modal fade" id="edit-pelanggan<?php echo $pelanggan['idpelanggan'];?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Edit Data Pelanggan</h4>
                        </div>
                        <form action="editpelanggan.php" method="POST">
                          <div class="modal-body">
                            <div class="form-group">
                              <label>Nama Pelanggan</label>
                              <input type="hidden" class="form-control" name="idpelanggan" value="<?php echo $pelanggan['idpelanggan'];?>">
                              <input type="text" class="form-control" name="nama" value="<?php echo $pelanggan['nama'];?>">
                            </div>
                            <div class="form-group">
                              <label>Alamat</label>
                              <input type="text" class="form-control" name="alamat" value="<?php echo $pelanggan['alamat'];?>">
                            </div>
                            <div class="form-group">
                              <label>Telepon</label>
                              <input type="number" class="form-control" name="telepon" value="<?php echo $pelanggan['telepon'];?>">
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
                  <a href="hapuspelanggan.php?idpelanggan=<?php echo $pelanggan['idpelanggan'];?>" class="btn btn-danger" role="button" title="hapus"><i class="glyphicon glyphicon-trash"></i></a>
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
<div class="modal fade" id="tambah-pelanggan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Data Pelanggan</h4>
      </div>
      <form action="tambahpelanggan.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Pelanggan</label>
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