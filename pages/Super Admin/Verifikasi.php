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
<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedBulan = $_POST["bulan"];
    $sql = "SELECT * FROM pembayaran_spp WHERE bulan = '$selectedBulan'";
} else {
    $sql = "SELECT * FROM pembayaran_spp";
}
$sql2 = "SELECT * FROM pembayaran_spp";
$tampil = mysqli_query($koneksi, $sql);
$tampil2 = mysqli_query($koneksi, $sql2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin | Veerifikasi Peembayaran</title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="../../dist/css/kel1-3.css"> -->
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<style>
    /* -------------- CSS Punya Main content ------------------ */

    .komp {
        display: grid;
        background-color: #ffffff;
        width: auto;
        height: 100px;
        color: #1f261f;
        grid-template-columns: 2fr 2fr;
        border-radius: 20px;
    }

    .komp .isi-komponen1 {
        display: flex;
        /* padding: 25px 30px; */
        /* text-align: center; */
        justify-content: center;
        align-items: center;
    }

    .komp .isi-komponen2 {
        display: grid;
        /* padding: 25px 30px; */
        /* text-align: center; */
        justify-content: center;
        align-items: center;
        justify-items: center;
    }

    .komp_table {
        /* width: auto auto; */
        margin-top: 30px;
        background-color: #ffffff;
        box-sizing: border-box;
    }
</style>

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
                            <h1 style="color: #fff;margin-top:70px;"><b>Verifikasi Pembayaran</b></h1>
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
                                    <div class="komp">
                                        <div class="isi-komponen1">
                                            <h4>CARI BULAN </h4>
                                        </div>
                                        <div class="isi-komponen2">
                                            <form action="" method="post">
                                                <select class="form-select" aria-label="Default select example" id="bulan" name="bulan">
                                                    <option selected>PILIH BULAN </option>
                                                    <?php
                                                    while ($baris1 = mysqli_fetch_assoc($tampil2)) {
                                                    ?>
                                                        <option value="<?php echo $baris1["bulan"]; ?>"><?php echo $baris1["bulan"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <!-- <div class="box-header mb-3" style="display: flex; justify-content: space-between; align-items: center;">
                                                    <div>
                                                        <a href="" class="btn btn-danger" id="resetFilter"><i class="fa fa-plus-circle"></i> Reset</a>
                                                        <button type="submit" name="submit" class="btn btn-success">
                                                            <i class="fa fa-print"></i> Cari
                                                        </button>
                                                    </div>


                                                </div> -->
                                                <div style="margin-left:1.4rem;">
                                                    <!-- -->
                                                    <button type="submit" class="btn btn-success">Cari</button>
                                                    <a href="" class="btn btn-danger" id="resetFilter">Reset</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="komp_table">
                                        <table class="table border table-bordered border-dark" style="text-align: center;">
                                            <thead class="fw-bold">
                                                <tr>
                                                    <td>ID MURID</td>
                                                    <td>BULAN</td>
                                                    <td>TANGGAL BAYAR</td>
                                                    <td>NOMINAL BAYAR</td>
                                                    <td>DEADLINE</td>
                                                    <td>STATUS</td>
                                                    <td>AKSI</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                while ($baris = mysqli_fetch_assoc($tampil)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $baris['murid_id']; ?></td>
                                                        <td><?php echo $baris["bulan"]; ?></td>
                                                        <td><?php echo $baris["tanggal_bayar"]; ?></td>
                                                        <td><?php echo $baris["nominal_bayar"]; ?></td>
                                                        <td><?php echo $baris["deadline_pembayaran"]; ?></td>
                                                        <td><?php echo $baris["status_bayar"]; ?></td>
                                                        <td>
                                                            <a href="../verifikasi_pembayaran.php?id=<?php echo $baris['id_pembayaran']; ?>" class="btn btn-primary">Verifikasi</a>
                                                            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" onclick="setDeleteURL(<?php echo $baris['id_pembayaran']; ?>)">Hapus</a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Konfirmasi Penghapusan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus data ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <a id="confirmDelete" href="#" class="btn btn-danger">Hapus</a>
                                                </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    // Tangani perubahan nilai pada elemen <select>
    document.getElementById("id_jadwal").addEventListener("change", function() {
        // Dapatkan nilai yang dipilih
        var selectedValue = this.value;

        // Masukkan nilai ke dalam modal
        document.getElementById("selectedValue").textContent = selectedValue;
    });
    document.getElementById("resetFilter").addEventListener("click", function() {
        document.getElementById("id_jadwal").selectedIndex = 0; // Setel kembali ke opsi default
        document.querySelector("form").submit(); // Submit form untuk menghapus filter
    });

    function setDeleteURL(id) {
        document.getElementById('confirmDelete').href = '../hapus_pembayaran.php?id=' + id;
    }
</script>
</script>