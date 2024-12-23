    <?php
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telepon = $_POST['telepon'];
    $conn = mysqli_connect('127.0.0.1:3307', 'root', '', 'sistemkasir');
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    mysqli_query($conn, "INSERT INTO tb_pelanggan values ('', '$nama','$alamat','$telepon')");

    header("location:pelanggan.php");

