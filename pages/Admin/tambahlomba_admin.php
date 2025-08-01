<?php
    session_start();
    if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
        header("Location: ../../index.php");
    }
    $aktorr = $_SESSION['id_aktor'];
    $koneksi = mysqli_connect("localhost", "root", "", "jokotole");
    $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
    $hasill = mysqli_query($koneksi, $sql);
    $bariss = mysqli_fetch_assoc($hasill);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin | Tambah Lomba</title>

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
    <style>
        .card {
            margin: 20px;
            /* Beri jarak dari tepi card */
            padding: 20px;
            /* Beri ruang di dalam card */
        }

        label {
            font-weight: bold;
            /* Beri teks label tebal */
        }

        input[type="text"],
        textarea {
            width: 100%;
            /* Isi seluruh lebar parent */
            padding: 8px;
            /* Beri ruang di dalam input dan textarea */
            margin-bottom: 10px;
            /* Beri jarak antar elemen */
        }

        select {
            width: 100%;
            /* Isi seluruh lebar parent */
            padding: 8px;
            /* Beri ruang di dalam select */
            margin-bottom: 10px;
            /* Beri jarak antar elemen */
        }

        input[type="file"] {
            margin-bottom: 10px;
            /* Beri jarak antar elemen */
        }

        button[type="submit"] {
            background-color: #007bff;
            /* Warna latar tombol */
            color: #fff;
            /* Warna teks tombol */
            padding: 10px 20px;
            /* Beri ruang di dalam tombol */
            border: none;
            /* Hilangkan garis pinggir tombol */
            cursor: pointer;
            /* Ubah kursor saat diarahkan ke tombol */
            font-size: 16px;
            /* Ukuran teks tombol */
            border-radius: 5px;
            /* Tambah sudut melengkung pada tombol */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-static-top" style="background-color: #818992;position: fixed; width: 100%; top:0;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #fff"></i></a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #fff;color:white;">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/<?php echo $bariss['foto'] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $bariss['nama'] ?></a>
                        <a href="#" style="font-size: 12px;"><i class="fa fa-circle text-success"></i> Admin</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="Dashboard_Admin.php" class="nav-link">
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
                            <a href="Merchandise.php" class="nav-link">
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
                            <a href="Materi.php" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Materi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Evaluasi.php" class="nav-link">
                                <i class="nav-icon fas fa-info "></i>
                                <p>
                                    Evaluasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Data_Siswa.php" class="nav-link">
                                <i class="nav-icon fas fa-graduation-cap "></i>
                                <p>
                                    Data Siswa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Verifikasi_Absen_Siswa.php" class="nav-link">
                                <i class="nav-icon fas fa-check "></i>
                                <p>
                                    Verifikasi Absensi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Jadwal.php" class="nav-link">
                                <i class="nav-icon fas fa-clock-o "></i>
                                <p>
                                    Jadwal
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
                            <a href="struktur.php" class="nav-link">
                                <i class="nav-icon 	fas fa-sitemap"></i>
                                <p>
                                    Struktur Organisasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="rekomendasilomba_Admin.php" class="nav-link">
                                <i class="nav-icon fa fa-handshake-o"></i>
                                <p>
                                    Rekomendasi Lomba
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pengajuan_lomba.php" class="nav-link">
                                <i class="nav-icon fa fa-trophy"></i>
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
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #BED2BE;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: black;margin-top:70px;"><b>Tambah Rekomendasi Lomba</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="top-section" style="background-color: #818992;color: #fff;">
                                    <!-- Konten bagian atas dengan latar belakang hitam -->
                                    <h1 style="color: #fff; background-color:#818992; text-align:center">Form Tambah Rekomendasi Lomba</h1>
                                </div>
                                <div class="card-body">


                                    <form action="proses_tambahlomba_Admin.php" method="post" enctype="multipart/form-data">
                                        <label for="judul">Judul:</label>
                                        <input type="text" id="judul" name="judul" required><br><br>

                                        <label for="deskripsi">Deskripsi:</label><br>
                                        <textarea id="deskripsi" name="deskripsi" rows="4" cols="50" required></textarea><br><br>

                                        <label for="tingkat">Tingkat Perlombaan:</label>
                                        <select id="tingkat" name="tingkat" required>
                                            <option value="" disabled selected hidden>Pilih Tingkatan</option>
                                            <option value="nasional">Nasional</option>
                                            <option value="internasional">internasional</option>
                                        </select><br><br>
                                        <label for="tempat">Tempat Lomba:</label><br>
                                        <input type="text" id="tempat" name="tempat" required><br><br>
                                        <label for="jurusan">Jurusan:</label>
                                        <select id="jurusan" name="jurusan" required>
                                            <option value="" disabled selected hidden>Pilih Jurusan</option>
                                            <option value="1">Seni</option>
                                            <option value="2">Tanding</option>
                                        </select><br><br>
                                        <label for="referensi">Referensi:</label>
                                        <input type="text" id="referensi" name="referensi"><br><br>

                                        <label for="foto">Foto:</label>
                                        <input type="file" id="foto" name="foto" accept="image/*" required><br><br>

                                        <input type="submit" value="Submit"><br><br>
                                    </form>
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

        <footer class="main-footer" style="background-color: #818992; position: fixed;bottom: 0;width: 100%;">
            <strong style="color: #fff">Copyright &copy; 2023 <a href="https://jokotole" style="color: darkblue;">Jokotole Kodim 0829</a>.</strong>
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
    <script src="../../dist/js/demo.js"></script>
</body>

</html>