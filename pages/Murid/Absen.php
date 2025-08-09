<?php

$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
session_start();

$id_murid = $_SESSION['id_aktor'];

if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
}

if (isset($_POST['submit_absensi'])) {
    $id_jadwal = $_POST['id_jadwal'];
    $tanggal_absensi = $_POST['tgl_absensi'];
    $resume_materi = $_POST['resume_materi'];

    $sql_insert = "INSERT INTO absensi(murid_id, jadwal_latihan_id, tanggal_absensi, resume_materi, status_absensi) 
                   VALUES('$id_murid', '$id_jadwal', '$tanggal_absensi', '$resume_materi', 'Belum ACC')";
    
    if (mysqli_query($koneksi, $sql_insert)) {
        header('location: Absen.php');
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

// 1. Ambil data jadwal yang belum diabsen oleh murid
$sql_jadwal_belum_absen = "SELECT j.id_jadwal, j.nama_latihan, j.jadwal_latihan 
                           FROM jadwal_latihan j 
                           LEFT JOIN absensi a ON j.id_jadwal = a.jadwal_latihan_id AND a.murid_id = '$id_murid' 
                           WHERE a.murid_id IS NULL";
$tampil_jadwal = mysqli_query($koneksi, $sql_jadwal_belum_absen);

// 4. Ambil data absensi murid yang sedang login untuk ditampilkan di tabel
$sql_riwayat_absensi = "SELECT j.nama_latihan, a.* FROM absensi a 
                        INNER JOIN jadwal_latihan j ON a.jadwal_latihan_id = j.id_jadwal
                        WHERE a.murid_id = '$id_murid'
                        ORDER BY a.tanggal_absensi DESC";
$tampil_riwayat = mysqli_query($koneksi, $sql_riwayat_absensi);

// Ambil data aktor untuk sidebar
$aktorr = $_SESSION['id_aktor'];
$sqlAktor = "SELECT * FROM aktor WHERE id_aktor = '$aktorr'";
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
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="box-header mb-3" style="display: flex; justify-content: flex-end; align-items: center;">
                                        <div class="form-group mb-0 mr-2">
                                            <label for="jadwal_dropdown" class="mb-0">Pilih Jadwal:</label>
                                            <select id="jadwal_dropdown" class="form-control" style="min-width: 250px;">
                                                <option value="">-- Pilih Jadwal Latihan --</option>
                                                <?php while ($jadwal = mysqli_fetch_assoc($tampil_jadwal)) { ?>
                                                    <option value="<?php echo $jadwal['id_jadwal']; ?>" data-nama="<?php echo htmlspecialchars($jadwal['nama_latihan'] . ' (' . $jadwal['jadwal_latihan'] . ')'); ?>">
                                                        <?php echo htmlspecialchars($jadwal['nama_latihan'] . ' (' . $jadwal['jadwal_latihan'] . ')'); ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <button type="button" id="btn_absensi" class="btn btn-primary mt-4" data-toggle="modal" data-target="#modalAbsensi" disabled>Absensi</button>
                                    </div>
                                    <hr>

                                    <div class="box-body">
                                        <table class="table table-bordered table-striped" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Latihan</th>
                                                    <th>Tanggal Absensi</th>
                                                    <th>Resume</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $a = 0;
                                                while ($baris = mysqli_fetch_assoc($tampil_riwayat)) {
                                                    $a += 1;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $a; ?></td>
                                                        <td><?php echo htmlspecialchars($baris["nama_latihan"]); ?></td>
                                                        <td><?php echo htmlspecialchars($baris["tanggal_absensi"]); ?></td>
                                                        <td><?php echo htmlspecialchars($baris["resume_materi"]); ?></td>
                                                        <td><?php echo htmlspecialchars($baris["status_absensi"]); ?></td>
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
        
        <div class="modal fade" id="modalAbsensi" tabindex="-1" role="dialog" aria-labelledby="modalAbsensiLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAbsensiLabel">Form Absensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="Absen.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id_jadwal" id="modal_id_jadwal">
                            <div class="form-group">
                                <label for="jadwal_info">Jadwal Latihan</label>
                                <input type="text" class="form-control" id="jadwal_info" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tgl_absensi">Tanggal Absensi</label>
                                <input type="date" class="form-control" id="tgl_absensi" name="tgl_absensi" readonly>
                            </div>
                            <div class="form-group">
                                <label for="resume_materi">Resume Materi</label>
                                <textarea class="form-control" id="resume_materi" name="resume_materi" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                            <button type="submit" name="submit_absensi" class="btn btn-primary">Kirim Absensi</button>
                        </div>
                    </form>
                </div>
            </div>
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
        $(document).ready(function() {
            // Aktifkan atau nonaktifkan tombol absensi berdasarkan pilihan dropdown
            $('#jadwal_dropdown').change(function() {
                if ($(this).val() !== "") {
                    $('#btn_absensi').prop('disabled', false);
                } else {
                    $('#btn_absensi').prop('disabled', true);
                }
            });

            // Saat modal terbuka, isi form secara otomatis
            $('#modalAbsensi').on('show.bs.modal', function() {
                var selectedJadwalId = $('#jadwal_dropdown').val();
                var selectedJadwalInfo = $('#jadwal_dropdown option:selected').data('nama');
                var today = new Date().toISOString().slice(0, 10);

                // Isi input hidden dan info jadwal
                $('#modal_id_jadwal').val(selectedJadwalId);
                $('#jadwal_info').val(selectedJadwalInfo);
                
                // Isi tanggal saat ini
                $('#tgl_absensi').val(today);
            });
        });
        
        // Fungsi pencarian lama yang sudah tidak relevan
        // function myFunctionfunc() { ... }
    </script>
</body>
</html>