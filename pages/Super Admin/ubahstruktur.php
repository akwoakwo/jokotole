<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$id = $_GET['id'];
$hasil = mysqli_query($koneksi, "SELECT id_aktor,nama, tanggal_lahir, telepon, gender, foto, alamat, status FROM aktor WHERE id_aktor=$id");
$data = mysqli_fetch_assoc($hasil);
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
    <style>
        *::-webkit-scrollbar {
            display: none;
        }
    </style>

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
        <?php
        session_start();
        if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
            header("Location: index.php");
        }
        $aktorr = $_SESSION['id_aktor'];
        $conn = mysqli_connect("localhost", "root", "", "jokotole");
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasill = mysqli_query($conn, $sql);
        $bariss = mysqli_fetch_assoc($hasill);
        ?>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #3B4045">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/<?php echo $bariss['foto'] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $bariss['nama'] ?></a>
                        <a href="#" style="font-size: 12px;"><i class="fa fa-circle text-success"></i> Super Admin</a>
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
                            <h1 style="color: #fff;margin-top:70px;"><b>Form Edit Struktur Organisasi</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 mb-5 ">
                            <!-- Default box -->
                            <div class="card mb-4">

                                <div class="card-body">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <form action="actionubahst.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <input type="hidden" name="id_aktor" value="<?php echo $data['id_aktor'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama : </label>
                                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="tanggal_lahir">Tanggal Lahir :</label>
                                                <input type="text" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="telepon">Telepon :</label>
                                                <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo $data['telepon'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="gender">Gender :</label>
                                                <input type="text" class="form-control" id="gender" name="gender" value="<?php echo $data['gender'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="alamat">Alamat :</label>
                                                <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data['alamat'] ?>">
                                            </div>


                                            <div class="form-group">
                                                <label for="foto">Foto :</label><br>
                                                <img style="width: 120px; margin-bottom: 10px;" src="../../dist/img/<?php echo $data['foto']; ?>">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="foto" name="foto" onchange="updateFileName()">
                                                    <label class="custom-file-label" for="foto" id="file-label"><?php echo $data['foto']; ?></label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="status">Status :</label>
                                                <input type="text" class="form-control" id="status" name="status" value="<?php echo $data['status'] ?>">
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update</button>
                                            <a href="strukturorganisasi.php" class="btn btn-outline-primary">Kembali</a>
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
        function updateFileName() {
            const input = document.getElementById('foto');
            const label = document.getElementById('file-label');

            if (input.files.length > 0) {
                // Jika file baru dipilih, tampilkan namanya
                const fileName = input.files[0].name;
                label.innerHTML = fileName;
            } else {
                // Jika tidak ada file baru yang dipilih, tampilkan nama file sebelumnya
                const previousFileName = "<?php echo $data['foto']; ?>";
                label.innerHTML = previousFileName;
            }
        }
    </script>

</body>

</html>