<?php

$idpelanggan = $_GET['idpelanggan'];

$conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'sistemkasir');

mysqli_query($conn, "DELETE FROM tb_pelanggan where idpelanggan = '$idpelanggan'");

header("location:pelanggan.php");

?>