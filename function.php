<?php

session_start();
$koneksi = mysqli_connect("localhost","root","","kasir");

if(isset($_POST["login"])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	$check = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username' AND password = '$password'");
	$hitung = mysqli_num_rows($check);

	if($hitung>0){
		$_SESSION['login']=true;
		header('location:index.php');
	} else {
		echo"
			<script>
				alert('Username atau Password salah')
				window.location.href='login.php'
			</script>
		";
	}
}

if(isset($_POST['tambahproduk'])){
	$msg = "";

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

if (isset($_POST['tambahpelanggan'])) {
    //deskripsi initial variable
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $notelp = $_POST['notelp'];
    $alamat = $_POST['alamat'];
  

    $insert_pelanggan = mysqli_query($koneksi,"INSERT INTO pelanggan (nama_pelanggan, notelp, alamat) VALUES ('$nama_pelanggan',
    '$notelp', '$alamat')");

    if($insert_pelanggan){
        header('location:pelanggan.php');
    } else {
        echo '
        <script>

        alert("Gagal Tambah Pelanggan")
        window.location.href="pelanggan.php"

        </script>';
    }

    
}

if(isset($_POST['tambahpesanan'])){
	$id_pelanggan = $_POST['id_pelanggan'];

	$insert_pesanan = mysqli_query($koneksi, "INSERT INTO pesanan (id_pelanggan) VALUES ('$id_pelanggan')");

	if ($insert_pesanan) {
		header('location:index.php');
	} else {
		echo"
			<script>
				alert('Gagal menambahkan data')
			</script>
		";
	}
}

if(isset($_POST['addproduk'])){
	$id_produk = $_POST['id_produk'];
	$idp = $_POST['idp'];
	$qty = $_POST['qty'];

	$hitung1 = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'");
	$hitung2 = mysqli_fetch_array($hitung1);
	$stoksekarang = $hitung2["stock"];

	if ($stoksekarang>=$qty) {
		$selisih = $stoksekarang-$qty;

		$insert = (mysqli_query($koneksi,"INSERT INTO detail_pesanan (id_pesanan, id_proudk, qty) VALUES ('$idp', '$id_produk', '$qty')"));
		$update = mysqli_query($koneksi,"UPDATE produk SET stock='$selisih' WHERE id_produk='$id_produk'");

		if ($insert && $update) {
			header("location:view.php?idp=".$idp);
		} else {
			echo"
				<script>
					alert('Gagal menambahkan data')
				</script>
			";
		}
	} else {
		
	}

	
}


?>