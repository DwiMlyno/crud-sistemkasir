<?php
include "config/koneksi.php";

$username = $_POST["username"];
$password = $_POST["password"];

$login = mysqli_query($koneksi, "SELECT * FROM tb_user where username = '$username' and
password = '$password'");
$cek = mysqli_num_rows($login);

if ($cek > 0){
    header("location:admin/index.php");
    
}else{
    header("location:assets/index2.html");
}