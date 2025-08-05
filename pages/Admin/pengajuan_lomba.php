<?php
session_start();
if (isset($_SESSION['pesantambah'])) { ?>
    <script>
        alert("Berhasil menambahkan Lomba!");
    </script>
<?php

    unset($_SESSION['pesantambah']); // Hapus pesan dari session
}
?>

<?php
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
    <title>Admin | Berita & Agenda</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
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

        <?php
        include 'siderbar/sidebar.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #BED2BE;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1 style="color: #000;margin-top:70px; text-align:center"><b>Daftar Pengajuan Lomba</b></h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-body">
                                    <table class="table">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Nama Murid</th>
                                                    <th>Nama Lomba</th>
                                                    <th>Status</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // include '../config.php';
                                                $query = mysqli_query($koneksi, "SELECT * FROM pengajuan_lomba ");
                                                while ($row = mysqli_fetch_assoc($query)) {
                                                    // Ambil informasi lomba berdasarkan id lomba
                                                    $id_murid = $row['murid_id'];
                                                    $id_lomba = $row['rekomendasi_id'];
                                                    $query_murid = mysqli_query($koneksi, "SELECT * FROM aktor WHERE id_aktor='$id_murid'");
                                                    $query_lomba = mysqli_query($koneksi, "SELECT * FROM rekomendasi_lomba WHERE id_rekomendasi='$id_lomba'");
                                                    $data_murid = mysqli_fetch_assoc($query_murid);
                                                    $data_lomba = mysqli_fetch_assoc($query_lomba);

                                                    echo "<tr>";
                                                    echo "<td>" . $data_murid['nama'] . "</td>";
                                                    echo "<td>" . $data_lomba['nama_perlombaan'] . "</td>"; // Tampilkan nama lomba
                                                    echo "<td>";
                                                    // Buat formulir untuk memilih status
                                                    echo "<form action='proses_ubah_status.php' method='post'>";
                                                    echo "<input type='hidden' name='id_pengajuan' value='" . $row['id_pengajuan'] . "'>"; // Sertakan id_pengajuan untuk identifikasi entri yang akan diubah
                                                    echo "<select name='status' onchange='this.form.submit()'>";
                                                    echo "<option value='diproses' " . ($row['status_pengajuan'] == 'diproses' ? 'selected' : '') . ">Diproses</option>";
                                                    echo "<option value='diterima' " . ($row['status_pengajuan'] == 'diterima' ? 'selected' : '') . ">Diterima</option>";
                                                    echo "<option value='ditolak' " . ($row['status_pengajuan'] == 'ditolak' ? 'selected' : '') . ">Ditolak</option>";
                                                    echo "</select>";
                                                    echo "</form>";
                                                    echo "</td>";
                                                    //echo "<td><a href='hapus_pengajuan.php?id_pengajuan=" . $row['id_pengajuan'] . "'>Hapus</a></td>"; // Tambahkan link untuk menghapus pengajuan
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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
</body>

</html>