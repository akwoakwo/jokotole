<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
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
    <title text-center>Super Admin | Dashboard</title text-center>

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
        if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
            header("Location: index.php");
        }
        // session_start();
        $aktorr = $_SESSION['id_aktor'];
        $conn = mysqli_connect("localhost", "root", "", "jokotole");
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasill = mysqli_query($conn, $sql);
        $bariss = mysqli_fetch_assoc($hasill);
        ?>

        <?php
        include 'sidebar/sidebar.php';
        ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #18191A;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #fff;margin-top:70px;"><b>Dashboard Utama</b></h1>
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
                                            <div class="row gy-4 mt-2" style="display: flex; justify-content: space-between; ">

                                                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100" style="border:1px solid black">
                                                    <div class="icon-box">
                                                        <?php
                                                        $sql = "SELECT COUNT(*) as jumlah_pelatih FROM aktor WHERE role = 'Admin'";
                                                        $hasil = mysqli_query($koneksi, $sql);
                                                        $data = mysqli_fetch_assoc($hasil);
                                                        $jumlah_pelatih = $data['jumlah_pelatih'];
                                                        ?>

                                                        <h4 class="title text-center"><a href="" class="stretched-link">Jumlah Pelatih</a></h4>
                                                        <h1 class="title text-center"><a href="" class="stretched-link"><?php echo $jumlah_pelatih; ?></a></h1>

                                                    </div>
                                                </div><!--End Icon Box -->

                                                <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100" style="border: 1px solid black;">
                                                    <div class="icon-box">
                                                        <?php
                                                        $sql1 = "SELECT COUNT(*) as jumlah_materi from materi";
                                                        $hasil2 = mysqli_query($koneksi, $sql1);
                                                        $data4 = mysqli_fetch_assoc($hasil2);
                                                        $jumlah_materi = $data4['jumlah_materi'];
                                                        ?>
                                                        <h4 class="title text-center"><a href="" class="stretched-link">Jumlah Materi Dasar</a></h4>
                                                        <h1 class="title text-center"><a href="" class="stretched-link"><?php echo $jumlah_materi; ?></a></h1>
                                                    </div>
                                                </div><!--End Icon Box -->

                                            </div>
                                        </div>
                                    </div>
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

        <footer class="main-footer" style="background-color: #292C30; position: fixed;bottom: 0;width: 100%;">
            <strong style="color: #fff">Copyright &copy; 2023 <a href="https://jokotole">Jokotole Kodim 0829</a>.</strong>
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