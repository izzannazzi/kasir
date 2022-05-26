<?php
session_start();

$koneksi = mysqli_connect('localhost', 'root', '', 'kasir');

if (isset($_POST['login'])){
    //initial variable
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
    $hitung = mysqli_num_rows($check);

    if($hitung>0){
        // jika datanya ada, dan ditemukan
        // maka berhasil login

        $_SESSION['login']=true;
        header('location:index.php');
    }else {
        //Datanya tidak ada
        // maka gagal login
        echo '
        <script>

        alert("Username atau Password salah")
        window.location.href="login.php"

        </script>';
    }
}

if (isset($_POST['tambahproduk'])) {
    //deskripsi initial variable
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];

    $insert_produk = mysqli_query($koneksi,"INSERT INTO produk (nama_produk, deskripsi, harga, stock) VALUES ('$nama_produk',
    '$deskripsi', '$harga', '$stock')");

    if($insert_produk){
        header('location:stock.php');
    } else {
        echo '
        <script>

        alert("Gagal Tambah Produk")
        window.location.href="stock.php"

        </script>';
    }
}

?>