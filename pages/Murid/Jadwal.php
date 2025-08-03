<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM jadwal_latihan j";
$hasil = mysqli_query($koneksi, $sql);
?>

<?php
session_start();
require_once("../Koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siswa | Jadwal Latihan</title>

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
        $aktorr = $_SESSION['id_aktor'];
        $koneksi = mysqli_connect("localhost", "root", "", "jokotole");
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasil = mysqli_query($koneksi, $sql);
        ?>
        <?php
        $baris = mysqli_fetch_assoc($hasil);
        $warna = $baris['jurusan_id'];
        if ($warna == '1') {
            $background = 'background-color:seagreen;';
            $namajurusan = 'Belum Menentukan Jurusan';
        }
        if ($warna == '2') {
            $background = 'background-color:tomato;';
            $namajurusan = 'Jurusan Tanding';
        }
        if ($warna == '3') {
            $background = 'background-color:steelblue;';
            $namajurusan = 'Jurusan Seni';
        }
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
                            <h1 style="color: #fff;margin-top:70px;"><b>Jadwal Latihan</b></h1>
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
                                    <div class="box-header mb-3" style="display: flex; justify-content: flex-end; align-items: center;">
                                        <div class="label-input-container">
                                            <label>Search:</label>
                                            <input type="search" id="inPutbarang" onkeyup="myFunctionfunc()" class="form-control" data-table="table-bordered" placeholder="Cari Jenis" />
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                     
                                    <div class="box-body">
                                        <table class="table table-bordered table-striped" id="taBelinventaris" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jenis</th>
                                                    <th>Jadwal Latihan</th>
                                                    <th>Nama Latihan</th>
                                                    <th>Deskripsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($baris = mysqli_fetch_assoc($hasil)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $baris['jenis_latihan'] ?></td>
                                                        <td><?php echo $baris['jadwal_latihan'] ?></td>
                                                        <td><?php echo $baris['nama_latihan'] ?></td>
                                                        <td><?php echo $baris['deskripsi_latihan'] ?></td>
                                                    </tr>
                                                <?php }; ?>
                                            </tbody>
                                        </table>
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

        <footer class="main-footer" style="background-color: #292C30; position: fixed; width: 100%;">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>