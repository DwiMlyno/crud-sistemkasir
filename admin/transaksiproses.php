<?php
$conn = mysqli_connect("127.0.0.1:3307", "root", "", "sistemkasir");

$notrans = $_POST['notrans'];
$idmenu = $_POST['menu'];
$jumlahmenu = $_POST['jumlah'];

$st = mysqli_query($conn, "SELECT harga FROM tb_menu where idmenu = '$idmenu'");
$harga = mysqli_fetch_assoc($st);
$subtotal = implode($harga) * $jumlahmenu;

mysqli_query($conn, "INSERT INTO tb_detailpenjualan values ('', '$notrans' , '$idmenu' , '$jumlahmenu' , '$subtotal')");

$stok = mysqli_query($conn, "SELECT stok FROM tb_menu where idmenu = '$idmenu'");
$s = mysqli_fetch_assoc($stok);
$update = implode($s) - $jumlahmenu;

mysqli_query($conn, "UPDATE tb_menu set stok='$update' where idmenu = '$idmenu'");

// Redirect tanpa output sebelumnya
header("Location: transaksitambah.php");
?>
