<?php

require 'function.php';

$h1 = mysqli_query($koneksi, "SELECT * FROM pesanan");
$h2 = mysqli_num_rows($h1);

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Aplikasi Kasir</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Order
                            </a>

                            <a class="nav-link" href="stock.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Stok Barang
                            </a>

                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="pelanggan.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                
                                Kelola Pelanggan
                            </a>

                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="fa fa-sign-out"></i></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola Pesanan</h1>
                        <div class="row">
                            <div class="col-xl-3 col-md-6 mb-2">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Jumlah Pesanan  : <?= $h2; ?> </div>
                                </div>
                                <div>   
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                        Tambah Pesanan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Pesanan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>id Pesanan</th>
                                            <th>Waktu Pemesanan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id Pesanan</th>
                                            <th>Waktu Pemesanan</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                            $getpesanan = mysqli_query($koneksi, "SELECT * FROM pesanan p, pelanggan pl WHERE p.id_pelanggan=pl.id_pelanggan");
                                        
                                            while ($p=mysqli_fetch_array($getpesanan)) {
                                                $id_pesanan = $p["id_pesanan"];
                                                $tanggal = $p["tgl_pesanan"];
                                                $nama_pelanggan = $p["nama_pelanggan"];
                                                $alamat = $p["alamat"];

                                            $hitungjumlah = mysqli_query($koneksi, "SELECT * FROM detail_pesanan WHERE id_pesanan = '$id_pesanan'");
                                            $jumlah = mysqli_num_rows($hitungjumlah);
                                        ?>
                                        <tr>
                                            <td><?= $id_pesanan ?></td>
                                            <td><?= $tanggal ?></td>
                                            <td><?= $nama_pelanggan ?> - <?= $alamat; ?></td>
                                            <td><?= $jumlah ?></td>
                                            <td> 
                                                <a href="view.php?idp=<?=$id_pesanan;?>" class="btn btn-primary" target="blank"> Tampilkan</a>
                                                <a href="hapus.php?idp=<?=$id_pesanan;?>" class="btn btn-danger"> Hapus</a>    
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Tauhid Izzan A 2022</div>
                            
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>

    <!-- The Modal -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Tambahkan Pesanan</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <!-- Modal body -->
          <form method="POST" action="" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="">
                <div class="">Pilih Pelanggan</div>
                <select name="id_pelanggan" class="form-control mt-2">
                <?php
                    $getpelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");

                    while ($plg = mysqli_fetch_array($getpelanggan)) {
                        $id_pelanggan = $plg["id_pelanggan"];
                        $nama_pelanggan = $plg["nama_pelanggan"];
                        $alamat = $plg["alamat"];
                    ?>
                    <option value="<?= $id_pelanggan ;?>"> <?= $nama_pelanggan; ?> - <?= $alamat; ?>
                        
                    </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
          </div>

          <!-- Modal footer -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" name="tambahpesanan">Tambah</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
          </div>
          </form>

        </div>
      </div>
    </div>
</html>
