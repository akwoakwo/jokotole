<?php
//menghubungkan dengan database
$koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');

session_start();
$id_admin = $_SESSION['id_aktor'];

$data_query = "SELECT * from aktor where id_aktor = $id_admin";
$tampil_aktor = mysqli_query($koneksi, $data_query);
$row = mysqli_fetch_assoc($tampil_aktor);

//melakukan query menampilkan data
$data_semua_murid = "SELECT nama, gender, nama_jurusan, tingkatan, telepon, telepon_wali FROM aktor inner join jurusan on aktor.jurusan_id = jurusan.id_jurusan where role = 'Siswa' and status = 'tetap'";
$hasil_1 = mysqli_query($koneksi, $data_semua_murid);

$data_murid_baru = "SELECT * FROM aktor where role = 'Siswa' and status = 'calon'";
$hasil_2 = mysqli_query($koneksi, $data_murid_baru);

$no_semua = 1;

// verifikasi murid
if (isset($_GET['id_edit'])) {
    $id_aktor = $_GET['id_edit'];

    // Melakukan query untuk mengubah status menjadi 'tetap'
    $query = "UPDATE aktor SET status = 'tetap' WHERE id_aktor = $id_aktor";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['success'] = "Berhasil menetapkan siswa baru !";
        header("Location: Verifikasi_Pendaftaran.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal menetapkan siswa baru !";
        header("Location: Verifikasi_Pendaftaran.php");
        exit();
    }
}

if (isset($_GET['id_hapus'])) {
    $id = $_GET["id_hapus"];

    // Melakukan query untuk menghapus data sesuai id yang dipilih
    $hapus_data = "DELETE FROM aktor WHERE id_aktor='$id' ";
    $hasil = mysqli_query($koneksi, $hapus_data);

    if ($hasil) {
        $_SESSION['success'] = "Berhasil menghapus calon siswa !";
        header("Location: Verifikasi_Pendaftaran.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal menghapus calon siswa !";
        header("Location: Verifikasi_Pendaftaran.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin | Verifikasi Siswa</title>

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
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
            header("Location: ../../index.php");
        }
        // session_start();
        $aktorr = $_SESSION['id_aktor'];
        $conn = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasill = mysqli_query($conn, $sql);
        $bariss = mysqli_fetch_assoc($hasill);
        ?>
        
        <!-- Main Sidebar Container -->
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
                            <h1 style="color: #fff;margin-top:70px;"><b>Verifikasi Siswa</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
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
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card">

                                <div class="card-body">

                                    <p>
                                        <a class="btn btn-primary" data-bs-toggle="collapse" href="#murid_baru" role="button" aria-expanded="false" aria-controls="murid_baru"> Siswa Baru ( <?php echo mysqli_num_rows($hasil_2) ?> )</a>
                                    </p>

                                    <div class="collapse" id="murid_baru">
                                        <div class="card card-body">
                                            <?php if (mysqli_num_rows($hasil_2) != 0) { ?>
                                                <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead class="text-center">
                                                        <tr>
                                                            <!-- <th>No.</th> -->
                                                            <th>Nama</th>
                                                            <th>Jenis Kelamin</th>
                                                            <th style="width: 250px;">Alamat</th>
                                                            <th>Telp. Siswa</th>
                                                            <th>Telp. Wali</th>
                                                            <th>Operasi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="text-center">
                                                        <?php while ($data_baru = mysqli_fetch_assoc($hasil_2)) { ?>
                                                            <tr class="kolom">

                                                                <td><?php echo $data_baru["nama"]; ?></td>
                                                                <td><?php echo $data_baru["gender"]; ?></td>
                                                                <td style="width: 250px;"><?php echo $data_baru["alamat"]; ?></td>
                                                                <td><?php echo $data_baru["telepon"]; ?></td>
                                                                <td><?php echo $data_baru["telepon_wali"]; ?></td>
                                                                <td class="aksi">
                                                                    <!-- Tombol Edit Data Mahasiswa -->
                                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#edit<?php echo $data_baru['id_aktor'] ?>">confirm</button>
                                                                    <div class="modal fade" id="edit<?php echo $data_baru['id_aktor'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Penetapan Siswa</h5>
                                                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    Apakah anda yakin untuk mengonfirmasi <b><?php echo $data_baru['nama']; ?></b> sebagai murid ?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <a href="?id_edit=<?php echo $data_baru['id_aktor']; ?>" class="btn btn-success">Iya</a>
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <!-- Tombol Hapus Data Mahasiswa -->
                                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?php echo $data_baru['id_aktor'] ?>">delete</button>
                                                                    <div class="modal fade" id="hapus<?php echo $data_baru['id_aktor'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Siswa</h5>
                                                                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    Apakah anda yakin untuk menghapus data dari <b><?php echo $data_baru['nama']; ?></b> ?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                                    <a href="?id_hapus=<?php echo $data_baru['id_aktor']; ?>" class="btn btn-danger">Iya</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>

                                            <?php } else { ?>

                                                <p style="color: red; margin: 0px; padding: 0px">Tidak ada data murid baru</p>

                                            <?php } ?>
                                        </div>
                                    </div>

                                    <table class="table table-striped table-bordered">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Jurusan</th>
                                                <th>Tingkatan</th>
                                                <th>Telepon</th>
                                                <th>Telepon Wali</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            <!-- Menampilkan data yang ada di database -->
                                            <?php while ($murid_tetap = mysqli_fetch_assoc($hasil_1)) { ?>
                                                <tr class="kolom">
                                                    <td><?php echo $no_semua++ ?></td>
                                                    <td><?php echo $murid_tetap["nama"]; ?></td>
                                                    <td><?php echo $murid_tetap["gender"]; ?></td>
                                                    <td><?php echo $murid_tetap["nama_jurusan"]; ?></td>
                                                    <td><?php echo $murid_tetap["tingkatan"]; ?></td>
                                                    <td><?php echo $murid_tetap["telepon"]; ?></td>
                                                    <td><?php echo $murid_tetap["telepon_wali"]; ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>