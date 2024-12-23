<?php

$idmenu = $_GET['idmenu'];

$conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'sistemkasir');

mysqli_query($conn, "DELETE FROM tb_menu where idmenu = '$idmenu'");

header("location:menudata.php");

?>