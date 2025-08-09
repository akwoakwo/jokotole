<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

session_start();
$id_admin = $_SESSION['id_aktor'];

// query menampilkan aktor
$data_query = "SELECT * from aktor where id_aktor = $id_admin";
$hasil = mysqli_query($koneksi, $data_query);
$tampil_profil = mysqli_fetch_assoc($hasil);

//melakukan query menampilkan data
$data_materi = "SELECT * FROM materi";
$hasil = mysqli_query($koneksi, $data_materi);

// query hitung materi
$cek_jumlah_materi = "SELECT COUNT(id_materi) as jumlah_materi FROM materi";
$result = $koneksi->query($cek_jumlah_materi);
$row = $result->fetch_assoc();
$jumlah_materi = $row['jumlah_materi'];

$no = 1;

// Tambah Materi
if (isset($_POST['tambah_materi'])) {
    // Proses tambah materi
    $nama_materi = $_POST['nama_materi'];
    $deskripsi_materi = $_POST['deskripsi_materi'];

    // Proses upload gambar dan simpan ke direktori yang sesuai
    if (isset($_FILES['foto_materi'])) {
        $file_name = $_FILES['foto_materi']['name'];
        $file_tmp = $_FILES['foto_materi']['tmp_name'];
        $file_type = $_FILES['foto_materi']['type'];
        $target_dir = "../../dist/assets/img/materi/"; // Ganti dengan path direktori upload yang sesuai
        $target_file = $target_dir . $file_name;

        // Validasi dan periksa tipe file yang diizinkan
        $allowed_types = array("image/jpeg", "image/jpg", "image/png");
        if (in_array($file_type, $allowed_types)) {
            // Pindahkan file ke direktori upload
            move_uploaded_file($file_tmp, $target_file);

            // Simpan data ke database
            $insert_query = "INSERT INTO materi (nama_materi, deskripsi_materi, foto_materi) VALUES ('$nama_materi', '$deskripsi_materi', '$file_name')";
            $result = mysqli_query($koneksi, $insert_query);

            if ($result) {
                $_SESSION['success'] = "Materi Baru Berhasil Ditambah !";
                header("Location: Materi.php");
                exit();
            } else {
                $_SESSION['error'] = "Gagal menambahkan materi baru !";
                header("Location: Materi.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Tipe gambar tidak diizinkan! Coba lagi!";
            header("Location: Materi.php");
            exit();
        }
    }
}

// Edit Materi
if (isset($_POST['edit_materi'])) {
    // Ambil data dari formulir
    $id_materi = $_POST['id_materi'];
    $nama_materi = $_POST['nama_materi'];
    $deskripsi_materi = $_POST['deskripsi_materi'];

    // Proses upload gambar jika ada perubahan
    $nama_gambar = null;
    if (!empty($_FILES['foto_materi']['name'])) {
        $file_name = $_FILES['foto_materi']['name'];
        $file_tmp = $_FILES['foto_materi']['tmp_name'];
        $file_type = $_FILES['foto_materi']['type'];
        $target_dir = "../../dist/assets/img/materi/";
        $target_file = $target_dir . $file_name;
        $allowed_types = array("image/jpeg", "image/jpg", "image/png");

        // Validasi tipe file yang diizinkan
        if (in_array($file_type, $allowed_types)) {
            // Pindahkan file ke direktori upload
            if (move_uploaded_file($file_tmp, $target_file)) {
                $nama_gambar = $file_name;
            } else {
                $_SESSION['error'] = "Gagal mengunggah file!";
                header("Location: Materi.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Tipe gambar tidak diizinkan! Coba lagi!";
            header("Location: Materi.php");
            exit();
        }
    }

    // Perbarui data di database
    $update_query = "UPDATE materi SET nama_materi = '$nama_materi', deskripsi_materi = '$deskripsi_materi'";
    if ($nama_gambar !== null) {
        $update_query .= ", foto_materi = '$nama_gambar'";
    }
    $update_query .= " WHERE id_materi = $id_materi";
    $result = mysqli_query($koneksi, $update_query);

    if ($result) {
        $_SESSION['success'] = "Materi berhasil diupdate!";
        header("Location: Materi.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal mengupdate materi!";
        header("Location: Materi.php");
        exit();
    }
}

// Hapus Materi
if (isset($_GET['id_materi'])) {
    // Proses hapus materi
    $id_materi = $_GET['id_materi'];

    // Ambil informasi file foto materi yang akan dihapus
    $select_query = "SELECT foto_materi FROM materi WHERE id_materi = $id_materi";
    $result = mysqli_query($koneksi, $select_query);
    if ($row = mysqli_fetch_assoc($result)) {
        $file_to_delete = $row['foto_materi'];
        $file_path = "../../dist/assets/img/materi/" . $file_to_delete; // Ganti dengan path direktori upload yang sesuai

        // Hapus file foto materi dari direktori
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Hapus data dari database
        $delete_query = "DELETE FROM materi WHERE id_materi = $id_materi";
        $result = mysqli_query($koneksi, $delete_query);

        if ($result) {
            $_SESSION['success'] = "Materi berhasil dihapus !";
            header("Location: Materi.php");
            exit();
        } else {
            $_SESSION['error'] = "Gagal menghapus materi !";
            header("Location: Materi.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Materi Pembelejaran</title>

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
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #000;margin-top:70px;"><b>Materi</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Default box -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                            <div class="card-body">

                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah_materi">
                                    <i class="bi bi-plus-square"></i> Tambah
                                </button>
                                <br><br>

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

                                <div class="modal fade" id="tambah_materi" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Materi Baru</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 mb-3">
                                                            <label>Nama Materi</label>
                                                            <input type="text" name="nama_materi" class="form-control shadow-none" required>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label>Deskripsi Materi</label>
                                                            <textarea name="deskripsi_materi" class="form-control shadow-none" required></textarea>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label>Foto Materi</label>
                                                            <input type="file" name="foto_materi" class="form-control shadow-none" accept="image/*">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" name="tambah_materi" class="btn btn-primary text-white shadow-none">Tambah</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <?php if ($jumlah_materi === '0') {
                                    echo "<p style='text-align:center; color: red;'>Belum Ada Materi Pembelajaran</p>";
                                } else {
                                ?>
                                    <table class="table">
                                        <thead class="table-dark">
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Nama Teknik</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <tbody>
                                            <?php while ($data_baru = mysqli_fetch_assoc($hasil)) { ?>
                                                <tr class="kolom">
                                                    <td><?php echo $no++ ?></td>
                                                    <td><img src="../../dist/assets/img/materi/<?php echo $data_baru["foto_materi"]; ?>" alt="Gambar Materi" width="500"></td>
                                                    <td><?php echo $data_baru["nama_materi"]; ?></td>
                                                    <td class="text-justify"><?php echo $data_baru["deskripsi_materi"]; ?></td>
                                                    <td class="aksi">
                                                        <a href='materi_edit.php?id_edit=<?php echo $data_baru['id_materi']; ?>' class="btn btn-primary">Edit</a>

                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?php echo $data_baru['id_materi'] ?>">Delete</button>
                                                        <div class="modal fade" id="hapus<?php echo $data_baru['id_materi'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data Materi</h5>
                                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Apakah anda yakin untuk menghapus materi <b><?php echo $data_baru['nama_materi']; ?></b> ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                                        <a href="?id_materi=<?php echo $data_baru['id_materi']; ?>" class="btn btn-danger">Iya</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer" style="background-color: #818992; position: fixed;bottom: 0;width: 100%;">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>