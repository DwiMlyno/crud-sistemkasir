<?php
    $idmenu = $_POST['idmenu'];
    $namamenu = $_POST['namamenu'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'sistemkasir');
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    mysqli_query($conn, "UPDATE tb_menu set namamenu = '$namamenu', harga = '$harga', stok = '$stok' 
    where idmenu = '$idmenu'");

    header("location:menudata.php");

