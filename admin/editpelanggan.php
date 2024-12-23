<?php
    $idpelanggan = $_POST['idpelanggan'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'sistemkasir');
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    mysqli_query($conn, "UPDATE tb_pelanggan set nama = '$nama', alamat = '$alamat', telepon = '$telepon' where idpelanggan = '$idpelanggan'");

    header("location:pelanggan.php");

