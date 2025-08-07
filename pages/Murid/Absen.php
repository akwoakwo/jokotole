<?php

$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
session_start();

$id_murid = $_SESSION['id_aktor'];

if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
}
if (isset($_POST['submit'])) {
    $id_jadwal=$_POST['id_jadwal'];
    $tanggal_absensi =$_POST['tgl_absensi'];
    $resume_materi =$_POST['resume_materi'];

    $sql="INSERT INTO absensi(murid_id,jadwal_latihan_id,tanggal_absensi,resume_materi,status_absensi) VALUES('$id_murid','$id_jadwal','$tanggal_absensi','$resume_materi','belum ACC')";
    $tampil = mysqli_query($koneksi,$sql);
    header('location:Absen.php');
}

$sql = "SELECT jadwal_latihan.jadwal_latihan, absensi.* FROM absensi INNER JOIN jadwal_latihan ON absensi.jadwal_latihan_id = jadwal_latihan.id_jadwal ";
$sql2 = "SELECT * FROM jadwal_latihan";
$tampil = mysqli_query($koneksi, $sql);
$tampil2 = mysqli_query($koneksi, $sql2);

// Ambil data aktor untuk sidebar
$aktorr = $_SESSION['id_aktor'];
$sqlAktor = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
$hasilAktor = mysqli_query($koneksi, $sqlAktor);
$bariss = mysqli_fetch_assoc($hasilAktor);

$warna = $bariss['jurusan_id'];
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siswa | Absensi</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />
    <link href="../../dist/css/style.css" rel="stylesheet">
    
    <style>
        .table thead th {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-static-top" style="background-color: #292C30;position: fixed; width: 100%; top:0;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #fff"></i></a>
                </li>
            </ul>
        </nav>
        <?php include 'sidebar/sidebar.php'; ?>

        <div class="content-wrapper" style="background-color: #18191A;">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #fff;margin-top:70px;"><b>Absensi</b></h1>
                        </div>
                    </div>
                </div></section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="box-header mb-3" style="display: flex; justify-content: flex-end; align-items: center;">
                                        <div class="label-input-container">
                                            <label>Search:</label>
                                            <input type="search" id="inPutnamalatihan" onkeyup="myFunctionfunc()" class="form-control" data-table="table-bordered" placeholder="Cari Jadwal Latihan" />
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered table-striped" style="text-align: center;">
                                            <thead>
                                                <th>NO</th>
                                                <th>Absensi</th>
                                                <th>Tanggal Absensi</th>
                                                <th>Resume</th>
                                                <th>Status</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $a = 0;
                                                while ($baris = mysqli_fetch_assoc($tampil)) {
                                                    $a += 1;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $a; ?></td>
                                                        <td><?php echo $baris["jadwal_latihan"]; ?></td>
                                                        <td><?php echo $baris["tanggal_absensi"]; ?></td>
                                                        <td><?php echo $baris["resume_materi"]; ?></td>
                                                        <td><?php echo $baris["status_absensi"]; ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            </div>
        <footer class="main-footer" style="background-color: #292C30; position: fixed; bottom: 0; width: 100%;">
            <strong style="color: #fff">Copyright &copy; 2023 <a href="https://localhost:PPL" style="color: #fff;">Jokotole Kodim 0829</a>.</strong>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
            </aside>
        </div>
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>

    <script>
        // Fungsi pencarian
        function myFunctionfunc() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("inPutnamalatihan");
            filter = input.value.toUpperCase();
            table = document.getElementById("taBeljadwalatihan");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0]; // Kolom Nama Latihan ada di indeks ke-4 (indeks dimulai dari 0)
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>