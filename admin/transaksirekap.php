<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = mysqli_connect("127.0.0.1:3307", "root", "", "sistemkasir");
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$total = $_POST['totalharga'];
$tanggal = $_POST['tanggal'];
$notrans = $_POST['notrans'];
$idpelanggan= $_POST['pelanggan'];

mysqli_query($conn,"INSERT INTO tb_penjualan values ('$notrans', '$tanggal', '$total', '$idpelanggan')");


header("location : transaksidata.php");

