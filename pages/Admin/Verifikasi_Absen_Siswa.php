<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedJadwal = $_POST["id_jadwal"];
    $sql = "SELECT jadwal_latihan.jadwal_latihan, absensi.* FROM absensi INNER JOIN jadwal_latihan ON absensi.jadwal_latihan_id = jadwal_latihan.id_jadwal WHERE jadwal_latihan.id_jadwal = $selectedJadwal";
} else {
    $sql = "SELECT jadwal_latihan.jadwal_latihan, absensi.* FROM absensi INNER JOIN jadwal_latihan ON absensi.jadwal_latihan_id = jadwal_latihan.id_jadwal";
}
$sql2 = "SELECT * FROM jadwal_latihan";
$tampil = mysqli_query($koneksi, $sql);
$tampil2 = mysqli_query($koneksi, $sql2);

if (isset($_GET['id_edit'])) {
    $id_absensi = $_GET['id_edit'];
    
    // Logika verifikasi data, misalnya mengubah status_absensi menjadi "Terverifikasi"
    $sql = "UPDATE absensi SET status_absensi = 'ACC' WHERE id_absensi = $id_absensi";
    mysqli_query($koneksi, $sql);

    // Redirect kembali ke halaman utama
    header("Location: Verifikasi_Absen_Siswa.php");
}

if (isset($_GET['id_hapus'])) {
    $id_absensi = $_GET['id_hapus'];

    // Logika hapus data
    $sql = "DELETE FROM absensi WHERE id_absensi = $id_absensi";
    mysqli_query($koneksi, $sql);

    // Redirect kembali ke halaman utama
    header("Location: Verifikasi_Absen_Siswa.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Verifikasi Absen</title>

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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #000;margin-top:70px;"><b>Verifikasi Absen</b></h1>
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
                                            <h4>CARI JADWAL LATIHAN</h4>
                                        </div>
                                        <div class="isi-komponen2">
                                            <form action="" method="post">
                                                <select class="form-select" aria-label="Default select example" id="id_jadwal" name="id_jadwal">
                                                    <option selected>PILIH JADWAL LATIHAN</option>
                                                    <?php
                                                    while ($baris1 = mysqli_fetch_assoc($tampil2)) {
                                                    ?>
                                                        <option value="<?php echo $baris1["id_jadwal"]; ?>"><?php echo $baris1["jadwal_latihan"]; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div style="margin-left:2.8rem;">
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
                                                    <td>NO</td>
                                                    <td>JADWAL LATIHAN</td>
                                                    <td>TANGGAL ABSENSI</td>
                                                    <td>RESUME</td>
                                                    <td>STATUS</td>
                                                    <td>AKSI</td>
                                                </tr>
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
                                                        <td>
                                                            <a href="?id_edit=<?php echo $baris['id_absensi']; ?>" class="btn btn-primary">Verifikasi</a>
                                                            <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" onclick="setDeleteURL(<?php echo $baris['id_absensi']; ?>)">Hapus</a>
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
        document.getElementById('confirmDelete').href = '?id_hapus=' + id;
    }
</script>
</script>