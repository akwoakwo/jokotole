<?php
$koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');
?>

<?php

// Memanggil id edit dari file tampil_data.php
session_start();
require_once("../Koneksi.php");

if (!isset($_SESSION['id_aktor'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan.'); window.location='Kelayakan.php';</script>";
    exit();
}

$id = intval($_GET['id']);
$query = "SELECT * FROM kelayakan_naik_tingkat WHERE murid_id = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<script>alert('Data tidak ditemukan.'); window.location='Kelayakan.php';</script>";
    exit();
}

$data = mysqli_fetch_assoc($result);


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
    <title>Admin | Edit Kelayakan Naik Tingkat</title>

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
        $conn = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');
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
                            <h1 style="color: #000; margin:70px 0px 0px;"><b>Edit Kelayakan Naik Tingkat</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>


            <!-- Main content -->

            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <div class="box-header mb-3" style="display: flex; justify-content: space-between; align-items: center;">
                                        <div>
                                            <a href="Kelayakan.php" class="btn btn-secondary">Kembali</a>
                                            <button type="reset" class="btn btn-primary text-white shadow-none">Reset</button>
                                            <button type="submit" name="update_kelayakan" class="btn btn-success text-white shadow-none">Simpan</button>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <form action="" method="post">
                                            <input type="hidden" name="id_kelayakan" value="<?php echo $row["id_kelayakan"]; ?>">
                                            <table class="table table-bordered table-striped" id="taBelinventaris" style="text-align: center;">
                                                <thead>
                                                    <tr>
                                                        <th>Syarat Kelayakan</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
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
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer" style="background-color: #818992;">
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
    <script src="../../dist/js/demo.js"></script>
</body>

</html>