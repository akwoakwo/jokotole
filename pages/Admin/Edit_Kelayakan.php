<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

// Memanggil id edit dari file tampil_data.php
$id = $_GET["id_edit"];

$query_murid = "SELECT id_kelayakan, aktor.nama, jumlah_pertemuan, salam_perguruan, dasar_kaki, dasar_tangan, jurus_tangan, jurus_kaki, langkah_segitiga, hindaran, zigzag_abc, pasangan, seni, pertemuan_latihan_fisik  FROM aktor inner join kelayakan_naik_tingkat on aktor.id_aktor = kelayakan_naik_tingkat.murid_id where id_kelayakan = $id";
$data = mysqli_query($koneksi, $query_murid);
$row = mysqli_fetch_assoc($data);

$no = 1;


// ------------------------------------------- update kelayakan

if (isset($_POST['update_kelayakan'])) {
    $id_kelayakan = $_POST['id_kelayakan'];

    // Ambil data dari formulir
    $jumlah_pertemuan = $_POST['jumlah_pertemuan'];
    $salam_perguruan = $_POST['salam_perguruan'];
    $dasar_kaki = $_POST['dasar_kaki'];
    $dasar_tangan = $_POST['dasar_tangan'];
    $jurus_tangan = $_POST['jurus_tangan'];
    $jurus_kaki = $_POST['jurus_kaki'];
    $langkah_segitiga = $_POST['langkah_segitiga'];
    $hindaran = $_POST['hindaran'];
    $zigzag_abc = $_POST['zigzag_abc'];
    $pasangan = $_POST['pasangan'];
    $seni = $_POST['seni'];
    $pertemuan_latihan_fisik = $_POST['pertemuan_latihan_fisik'];

    // Perbarui data di database
    $update_query = "UPDATE kelayakan_naik_tingkat 
                       SET jumlah_pertemuan = '$jumlah_pertemuan', 
                           salam_perguruan = '$salam_perguruan', 
                           dasar_kaki = '$dasar_kaki', 
                           dasar_tangan = '$dasar_tangan', 
                           jurus_tangan = '$jurus_tangan',  
                           jurus_kaki = '$jurus_kaki', 
                           langkah_segitiga = '$langkah_segitiga', 
                           hindaran = '$hindaran', 
                           zigzag_abc = '$zigzag_abc', 
                           pasangan = '$pasangan', 
                           seni = '$seni', 
                           pertemuan_latihan_fisik = '$pertemuan_latihan_fisik' 
                       WHERE id_kelayakan = '$id_kelayakan'";

    $result = mysqli_query($koneksi, $update_query);

    if ($result) {
        echo "Data berhasil diperbarui.";
        header("Location: Kelayakan.php"); // Redirect kembali ke halaman Materi Pembelajaran
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Evaluasi Murid</title>

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
        td {
            border: 1px solid black
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
        <?php
        session_start();
        if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
            header("Location: ../../index.php");
        }
        $aktorr = $_SESSION['id_aktor'];
        $conn = mysqli_connect("localhost", "root", "", "jokotole");
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasill = mysqli_query($conn, $sql);
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
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 style="color: #000; margin:70px 0px 0px;"><b>EDIT KELAYAKAN NAIK TINGKAT</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <!-- Main content -->

            <section class="content" style="padding-bottom: 75px;">

                <div class="container-fluid">
                    <div style="display: flex; justify-content: center; align-items: center;">
                        <div class="row">
                            <div class="col-15">
                                <!-- Default box -->
                                <div class="card" width=750px>


                                    <div class="card card-body">
                                        <form action="" method="post">
                                            <input type="hidden" name="id_kelayakan" value="<?php echo $row["id_kelayakan"]; ?>">
                                            <table style="border : 1px solid black; width: 750px; text-align: center;">
                                                <thead>
                                                    <tr>
                                                        <td>No</td>
                                                        <td>Nama</td>
                                                        <td>Syarat Kelayakan</td>
                                                        <td>Status</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td rowspan="12" style="border : 1px solid black"><?php echo $no++ ?></td>
                                                        <td rowspan="12" style="border : 1px solid black"><?php echo $row["nama"]; ?></td>
                                                        <td>Jumlah Pertemuan</td>
                                                        <td>
                                                            <input type="number" class="form-control shadow-none" name="jumlah_pertemuan" value="<?php echo $row["jumlah_pertemuan"]; ?>" min="<?php echo $row["jumlah_pertemuan"]; ?>" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Salam Perjuruan</td>
                                                        <td>
                                                            <select class="form-select custom-select fw-bold" name="salam_perguruan" required>
                                                                <option value="hafal" <?php echo ($row["salam_perguruan"] == 'hafal') ? 'selected' : ''; ?>>Hafal</option>
                                                                <option value="belum hafal" <?php echo ($row["salam_perguruan"] == 'belum hafal') ? 'selected' : ''; ?>>Belum
                                                                    Hafal</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dasar Kaki</td>
                                                        <td>
                                                            <select class="form-select custom-select fw-bold" name="dasar_kaki" required>
                                                                <option value="hafal" <?php echo ($row["dasar_kaki"] == 'hafal') ? 'selected' : ''; ?>>
                                                                    Hafal</option>
                                                                <option value="belum hafal" <?php echo ($row["dasar_kaki"] == 'belum hafal') ? 'selected' : ''; ?>>Belum Hafal
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Dasar Tangan</td>
                                                        <td>
                                                            <select class="form-select custom-select fw-bold" name="dasar_tangan" required>
                                                                <option value="hafal" <?php echo ($row["dasar_tangan"] == 'hafal') ? 'selected' : ''; ?>>Hafal</option>
                                                                <option value="belum hafal" <?php echo ($row["dasar_tangan"] == 'belum hafal') ? 'selected' : ''; ?>>Belum Hafal
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jurus Tangan</td>
                                                        <td>
                                                            <select class="form-select custom-select fw-bold" name="jurus_tangan" required>
                                                                <option value="hafal" <?php echo ($row["jurus_tangan"] == 'hafal') ? 'selected' : ''; ?>>Hafal</option>
                                                                <option value="belum hafal" <?php echo ($row["jurus_tangan"] == 'belum hafal') ? 'selected' : ''; ?>>Belum Hafal
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jurus Kaki</td>
                                                        <td>
                                                            <select class="form-select custom-select fw-bold" name="jurus_kaki" required>
                                                                <option value="hafal" <?php echo ($row["jurus_kaki"] == 'hafal') ? 'selected' : ''; ?>>
                                                                    Hafal</option>
                                                                <option value="belum hafal" <?php echo ($row["jurus_kaki"] == 'belum hafal') ? 'selected' : ''; ?>>Belum Hafal
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Langkah Segitiga</td>
                                                        <td>
                                                            <select class="form-select custom-select fw-bold" name="langkah_segitiga" required>
                                                                <option value="hafal" <?php echo ($row["langkah_segitiga"] == 'hafal') ? 'selected' : ''; ?>>Hafal</option>
                                                                <option value="belum hafal" <?php echo ($row["langkah_segitiga"] == 'belum hafal') ? 'selected' : ''; ?>>Belum
                                                                    Hafal</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hindaran 1 dan 2</td>
                                                        <td>
                                                            <select class="form-select custom-select fw-bold" name="hindaran" required>
                                                                <option value="hafal" <?php echo ($row["hindaran"] == 'hafal') ? 'selected' : ''; ?>>
                                                                    Hafal</option>
                                                                <option value="belum hafal" <?php echo ($row["hindaran"] == 'belum hafal') ? 'selected' : ''; ?>>Belum Hafal
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Zig-Zag ABC</td>
                                                        <td>
                                                            <select class="form-select custom-select fw-bold" name="zigzag_abc" required>
                                                                <option value="hafal" <?php echo ($row["zigzag_abc"] == 'hafal') ? 'selected' : ''; ?>>
                                                                    Hafal</option>
                                                                <option value="belum hafal" <?php echo ($row["zigzag_abc"] == 'belum hafal') ? 'selected' : ''; ?>>Belum Hafal
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pasangan 1</td>
                                                        <td>
                                                            <select class="form-select custom-select fw-bold" name="pasangan" required>
                                                                <option value="hafal" <?php echo ($row["pasangan"] == 'hafal') ? 'selected' : ''; ?>>
                                                                    Hafal</option>
                                                                <option value="belum hafal" <?php echo ($row["pasangan"] == 'belum hafal') ? 'selected' : ''; ?>>Belum Hafal
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Seni 1</td>
                                                        <td>
                                                            <select class="form-select custom-select fw-bold" name="seni" required>
                                                                <option value="hafal" <?php echo ($row["seni"] == 'hafal') ? 'selected' : ''; ?>>Hafal
                                                                </option>
                                                                <option value="belum hafal" <?php echo ($row["seni"] == 'belum hafal') ? 'selected' : ''; ?>>Belum Hafal</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pertemuan Latihan Fisik</td>
                                                        <td>
                                                            <input type="number" class="form-control shadow-none" name="pertemuan_latihan_fisik" value="<?php echo $row["pertemuan_latihan_fisik"]; ?>" min="<?php echo $row["pertemuan_latihan_fisik"]; ?>" required>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <br>
                                            <button type="reset" class="btn btn-primary text-white shadow-none">reset</button>
                                            <button type="submit" name="update_kelayakan" class="btn btn-success text-white shadow-none">Simpan</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </td>
                </tr>
        </div>



        </section>

        <!-- /.content -->
        <!-- /.content-wrapper -->
    </div>


    <footer class="main-footer" style="background-color: #818992; position: fixed;bottom: 0;width: 100%;">
        <strong style="color: #fff">Copyright &copy; 2023 <a href="https://jokotole" style="color: darkblue;">Jokotole
                Kodim 0829</a>.</strong>
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