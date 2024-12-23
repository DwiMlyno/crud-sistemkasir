<?php
//koneksi
$conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'sistemkasir');

//login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password =$_POST['password'];


    $check = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$username' and password='$password'");
    $hitung = mysqli_num_rows($check);

    if($hitung>0){
        $_SESSION['login'] = 'True';
        header('location:admin/index.php');
    }else{
        echo '
        <script>alert("Username atau Password salah");
        window.location.href="index.php"
        </script>';
    }
}


