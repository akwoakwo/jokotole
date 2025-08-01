<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Vendor CSS Files -->
    <link href="../../dist/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../dist/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../dist/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />
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

                <!-- Sidebar Menu -->
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
                <!-- /.sidebar-menu -->
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
                            <h1 style="color: #000;margin-top:70px;"><b>Dashboard Utama</b></h1>
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

                                <div class="card-body">
                                <div class="icon-boxes position-relative" style="background-color: transparent;">
                                        <div class="container position-relative" style="background-color: transparent;">
                                            <div class="row gy-4 mt-5 mb-5" style="border:1px solid black">
                                                <h4 class="title text-center text-bold">JUMLAH SISWA</h4>
                                                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100" style="border:1px solid black">
                                                    <div class="icon-box">
                                                        <?php
                                                        $sql2 = "SELECT COUNT(*) as seni FROM aktor JOIN jurusan ON aktor.jurusan_id = jurusan.id_jurusan WHERE jurusan.id_jurusan = 1 AND aktor.role = 'Siswa';";
                                                        $hasil2 = mysqli_query($koneksi, $sql2);
                                                        $data = mysqli_fetch_assoc($hasil2);
                                                        $jumlahSiswaSeni = $data['seni'];
                                                        ?>

                                                        <br>
                                                        <h2 class="title text-center"><a href="" class="stretched-link"><?php echo $jumlahSiswaSeni; ?></a></h2>

                                                        <h4 class="title text-center"><a href="" class="stretched-link">Siswa Seni</a></h4>
                                                    </div>
                                                </div><!--End Icon Box -->

                                                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100" style="border:1px solid black">
                                                    <div class="icon-box">
                                                        <?php
                                                        $sql3 = "SELECT COUNT(*) as tanding FROM aktor JOIN jurusan ON aktor.jurusan_id = jurusan.id_jurusan WHERE jurusan.id_jurusan = 2 AND aktor.role = 'Siswa';";
                                                        $hasil3 = mysqli_query($koneksi, $sql3);
                                                        $data3 = mysqli_fetch_assoc($hasil3);
                                                        $jumlahSiswaTanding = $data3['tanding'];
                                                        ?>

                                                        <br>
                                                        <h2 class="title text-center"><a href="" class="stretched-link"><?php echo $jumlahSiswaTanding; ?></a></h2>

                                                        <h4 class="title text-center"><a href="" class="stretched-link">Siswa Tanding</a></h4>
                                                    </div>
                                                </div><!--End Icon Box -->

                                                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100" style="border: 1px solid black;">
                                                    <div class="icon-box">
                                                        <?php
                                                        $sql4 = "SELECT COUNT(*) as belum FROM aktor JOIN jurusan ON aktor.jurusan_id = jurusan.id_jurusan WHERE jurusan.id_jurusan = 0 AND aktor.role = 'Siswa';";
                                                        $hasil4 = mysqli_query($koneksi, $sql4);
                                                        $data4 = mysqli_fetch_assoc($hasil4);
                                                        $BelumMenentukan = $data4['belum'];
                                                        ?>
                                                        <br>
                                                        <h2 class="title text-center"><a href="" class="stretched-link"><?php echo $BelumMenentukan; ?></a></h2>
                                                        <h4 class="title text-center"><a href="" class="stretched-link">Belum Menentukan Jurusan</a></h4>
                                                    </div>
                                                </div><!--End Icon Box -->

                                                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100" style="border: 1px solid black;">
                                                    <div class="icon-box">
                                                        <?php
                                                        $sql5 = "SELECT COUNT(*) as calon FROM aktor WHERE role = 'Siswa' AND status = 'calon';";
                                                        $hasil5 = mysqli_query($koneksi, $sql5);
                                                        $data5 = mysqli_fetch_assoc($hasil5);
                                                        $calon = $data5['calon'];
                                                        ?>
                                                        <br>
                                                        <h2 class="title text-center"><a href="" class="stretched-link"><?php echo $calon; ?></a></h2>
                                                        <h4 class="title text-center"><a href="" class="stretched-link">Calon Siswa</a></h4>
                                                    </div>
                                                </div><!--End Icon Box -->

                                            </div>
                                        </div>
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