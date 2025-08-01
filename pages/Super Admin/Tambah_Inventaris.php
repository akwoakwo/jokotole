<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM inventaris i";
$hasil = mysqli_query($koneksi, $sql);
?>


<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
}
require_once("../Koneksi.php");

if (isset($_POST['simpan'])) {
    $namabarang = $_POST['nama_barang'];
    $jumlahbarang = $_POST['jumlah_barang'];

    if ($namabarang && $jumlahbarang != '') {
        $query = "INSERT INTO inventaris VALUES('','$namabarang','$jumlahbarang')";
        $queryact = mysqli_query($conn, $query);
        echo ("<script>location.href = 'Inventaris.php';</script>");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />
    <link href="../../dist/css/style.css" rel="stylesheet">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-static-top" style="background-color: #292C30;position: fixed; width: 100%; top:0;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #fff"></i></a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        // session_start();
        $aktorr = $_SESSION['id_aktor'];
        $conn = mysqli_connect("localhost", "root", "", "jokotole");
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasill = mysqli_query($conn, $sql);
        $bariss = mysqli_fetch_assoc($hasill);
        ?>
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #3B4045">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/<?php echo $bariss['foto'] ?>" class="img-circle elevation-3" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $bariss['nama'] ?></a>
                        <a href="#" style="font-size: 10px;"><i class="fa fa-circle text-success"></i> Super Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="Dashboard_SuperAdmin.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Profil_Perguruan.php" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Profil Perguruan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Kelola_Merchandise.php" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart "></i>
                                <p>
                                    Merchandise
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Penjurusan_Prestasi.php" class="nav-link">
                                <i class="nav-icon fas fa-road"></i>
                                <p>
                                    Penjurusan Prestasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Kelayakan.php" class="nav-link">
                                <i class="nav-icon fas fa-percent"></i>
                                <p>
                                    Kelayakan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Inventaris.php" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Inventaris
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Pesan.php" class="nav-link">
                                <i class="nav-icon fas fa-envelope "></i>
                                <p>
                                    Kotak Masuk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Verifikasi.php" class="nav-link">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>
                                    Verifikasi Pembayaran
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Materi.php" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Materi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Verifikasi_Pendaftaran.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                <p>
                                    Verifikasi Pendaftaran
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="galeriprestasi.php" class="nav-link">
                                <i class="nav-icon fas fa-trophy"></i>
                                <p>
                                    Galeri Prestasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="spp.php" class="nav-link">
                                <i class="nav-icon fas fa-receipt"></i>
                                <p>
                                    Informasi SPP
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="strukturorganisasi.php" class="nav-link">
                                <i class="nav-icon 	fas fa-sitemap"></i>
                                <p>
                                    Struktur Organisasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="beritaagenda_SuperAdmin.php" class="nav-link">
                                <i class=" nav-icon fa fa-newspaper-o"></i>
                                <p>
                                    Berita dan Agenda
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="rekomendasilomba_SuperAdmin.php" class="nav-link">
                                <i>
                                    <i class="nav-icon fa fa-handshake-o"></i>
                                </i>
                                <p>
                                    Rekomendasi Lomba
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Inventaris.php" class="nav-link">
                                <i>
                                    <i class="nav-icon fa fa-trophy"></i>
                                </i>
                                <p>
                                    Pengajuan Lomba
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Pengaturan.php" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Pengaturan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                                <i class="nav-icon fas fa fa-sign-out"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #18191A;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #fff;margin-top:70px;"><b>Inventaris Barang</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal" role="document">
                    <div class="modal-content shadow">
                        <div class="modal-header bg-light shadow-sm" style="background-color: #BED2BE !important;">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tambah Data Inventaris</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="image text-center">
                                            <img src="../../dist/img/Jokotole.png" width="200" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menambah ini?
                                            <br>
                                            <b id="outputNamaBarang" style="color: #18191A;"></b><br>
                                            <b id="outputJumlahBarang" style="color: #18191A;"></b>
                                            <br><br>
                                            <button type="button" class="btn bg-navy" data-dismiss="modal">Batal</button>
                                            <button type="button" class="btn bg-olive" id="confirmBtn" onclick="confirmAction()">Ya, Lanjutkan</button>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer shadow-sm" style="background-color: #BED2BE;">
                        </div>
                    </div>
                </div>
            </div>


            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">

                                <div class="card-body">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label for="nama_barang">Nama Barang *</label>
                                                <input type="text" name="nama_barang" id="nama_barang" class="form-control" required oninvalid="this.setCustomValidity('Kolom Nama Barang Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                            </div>
                                            <div class="form-group">
                                                <label for="jumlah_barang">Jumlah Barang *</label>
                                                <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" required oninvalid="this.setCustomValidity('Kolom Jumlah Barang Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                            </div>
                                            <a href="Inventaris.php" class="btn bg-navy"><i class="fa fa-arrow-left"></i> Kembali</a>
                                            <button type="button" name="simpan" onclick="confirmAction()" class="btn bg-olive" data-toggle="modal" data-target="#myModal">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                        </form>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer" style="background-color: #292C30; position: fixed;bottom: 0;width: 100%;">
            <strong style="color: #fff">Copyright &copy; 2023 <a href="https://localhost:PPL">Jokotole Kodim 0829</a>.</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->

    <script type="text/javascript" src="../../dist/js/pages/search.js"></script>
    <script>
        document.getElementById('confirmBtn').addEventListener('click', function() {
            // Mengambil nilai input dari form
            var namaBarang = document.getElementById('nama_barang').value;
            var jumlahBarang = document.getElementById('jumlah_barang').value;

            // Validasi input di sini jika diperlukan

            // Kirim permintaan AJAX ke halaman yang sama (Inventaris.php) dengan data yang dikirimkan sebagai POST
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'Tambah_Inventaris.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status == 200) {
                    // Handle response dari server (jika perlu)
                    <?php $_SESSION['success_message'] = 'Data baru berhasil ditambahkan.'; ?>;
                    location.href = 'Inventaris.php';
                } else {
                    // Handle kesalahan jika diperlukan
                    alert('Terjadi kesalahan. Data tidak dapat disimpan.');
                }
            };
            // Mengirim data form menggunakan AJAX
            xhr.send('simpan=true&nama_barang=' + encodeURIComponent(namaBarang) + '&jumlah_barang=' + encodeURIComponent(jumlahBarang));
            // Tutup modal konfirmasi
            $('#confirmationModal').modal('hide');
        });
    </script>
    <script>
        function confirmAction() {
            var namaBarang = document.getElementById('nama_barang').value;
            var jumlahBarang = document.getElementById('jumlah_barang').value;

            // Menampilkan nilai Nama Barang dan Jumlah Barang di elemen HTML
            document.getElementById('outputNamaBarang').textContent = 'Nama Barang: ' + namaBarang;
            document.getElementById('outputJumlahBarang').textContent = 'Jumlah Barang: ' + jumlahBarang;
        }
    </script>



</body>

</html>