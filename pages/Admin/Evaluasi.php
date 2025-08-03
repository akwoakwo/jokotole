<?php
//menghubungkan dengan database
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

session_start();
$id_admin = $_SESSION['id_aktor'];

$data_query = "SELECT * from aktor where id_aktor = $id_admin";
$hasil = mysqli_query($koneksi, $data_query);
$row = mysqli_fetch_assoc($hasil);

$query_jadwal = "SELECT * FROM jadwal_latihan";
$query_murid = "SELECT * FROM aktor where role = 'Siswa'";

$tampil = mysqli_query($koneksi, $query_jadwal);
$tampil2 = mysqli_query($koneksi, $query_murid);

if (isset($_POST["kirim"])) {
    $jadwal = $_POST["id_jadwal"];
    $murid = $_POST["id_aktor"];
    $ulasan = $_POST["ulasan_pelatih"];


    $tambah_data = "INSERT INTO evaluasi_diri (murid_id, pelatih_id, jadwal_latihan_id, ulasan_pelatih) VALUES ('$murid', '$id_admin', '$jadwal', '$ulasan')";
    $hasil = mysqli_query($koneksi, $tambah_data);

    if ($hasil) {
        $_SESSION['success'] = "Berhasil memberikan evaluasi!";
        header("Location: evaluasi.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal memberikan evaluasi!";
        header("Location: evaluasi.php");
        exit();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="dist/assets/css/main.css" rel="stylesheet">
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
        
        <?php
            include 'siderbar/sidebar.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #BED2BE;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 style="color: #000; margin:70px 0px 0px;"><b>Evaluasi Murid</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12" style="padding-bottom: 75px;">
                            <!-- Modal untuk menampilkan pesan alert -->
                            <?php
                            if (isset($_SESSION['success'])) {
                                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                <i class='bi bi-check-circle me-1'></i>
                                                {$_SESSION['success']}
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
                                unset($_SESSION['success']);
                            }

                            if (isset($_SESSION['error'])) {
                                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                                <i class='bi bi-exclamation-circle me-1'></i>
                                                {$_SESSION['error']}
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
                                unset($_SESSION['error']);
                            }
                            ?>
                            <!-- End modal -->
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-body">
                                    <form action="" method="post">
                                        <!-- <div class="modal-content"> -->
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label fw-bold"> Jadwal Latihan </label>
                                                    <select class="form-select custom-select fw-bold" id="id_jadwal" name="id_jadwal" required>
                                                        <option value="" disabled selected>PILIH JADWAL LATIHAN</option>
                                                        <?php while ($jadwal = mysqli_fetch_assoc($tampil)) { ?>
                                                            <option value="<?php echo $jadwal["id_jadwal"]; ?>"><?php echo $jadwal["jadwal_latihan"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label fw-bold"> Data Murid </label>
                                                    <select class="form-select custom-select fw-bold" id="id_aktor" name="id_aktor" required>
                                                        <option value="" disabled selected>PILIH DATA MURID</option>
                                                        <?php while ($murid = mysqli_fetch_assoc($tampil2)) { ?>
                                                            <option value="<?php echo $murid["id_aktor"]; ?>"><?php echo $murid["nama"]; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label fw-bold"> Ulasan Pelatih </label>
                                                    <textarea name="ulasan_pelatih" class="form-control shadow-none" required></textarea>
                                                </div>
                                            </div>
                                            <button type="submit" name="kirim" class="btn btn-success">Simpan</button>
                                        </div>
                                        <!-- </div> -->
                                    </form>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
            <!-- /.content-wrapper -->
        </div>

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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>