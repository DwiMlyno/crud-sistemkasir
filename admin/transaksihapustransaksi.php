<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$conn = mysqli_connect("127.0.0.1:3307", "root", "", "sistemkasir");
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
$idmenu = $_GET['idmenu'];
$idpenjualan = $_GET['idpenjualan'];

$jml_stok = mysqli_query($conn, "SELECT jumlahmenu FROM tb_detailpenjualan where idmenu='$idmenu' AND idpenjualan = '$idpenjualan'");
$jml = mysqli_fetch_assoc($jml_stok);
$stok = mysqli_query($conn, "SELECT stok FROM tb_menu where idmenu='$idmenu'");
$s = mysqli_fetch_assoc($stok);

$tambahstok = implode($s) + implode($jml);

mysqli_query($conn, "UPDATE tb_menu SET stok = '$tambahstok' where idmenu = '$idmenu'");

mysqli_query($conn, "DELETE FROM tb_detailpenjualan where  idmenu='$idmenu' AND idpenjualan='$idpenjualan'");

header("location:transaksitambah.php");

?>