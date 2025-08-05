<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

// Pastikan pengguna sudah login dan role adalah Admin atau Pelatih
if (!isset($_SESSION['nama']) || !isset($_SESSION['id_aktor']) || ($_SESSION['role'] != 'Admin')) {
    header("Location: ../../index.php");
    exit();
}

$aktorId = $_SESSION['id_aktor'];

// Handle Aksi CRUD
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';

    if ($action == 'add_jadwal') {
        $pelatih_id = $_POST['pelatih_id'] ?? $aktorId;
        $nama_latihan = $_POST['nama_latihan'] ?? '';
        $jenis_latihan = $_POST['jenis_latihan'] ?? '';
        $deskripsi_latihan = $_POST['deskripsi_latihan'] ?? '';
        $jadwal_latihan = $_POST['jadwal_latihan'] ?? '';

        // Kode yang benar:
        $sql_add = "INSERT INTO jadwal_latihan (pelatih_id, nama_latihan, jenis_latihan, deskripsi_latihan, jadwal_latihan) VALUES ('$pelatih_id', '$nama_latihan', '$jenis_latihan', '$deskripsi_latihan', '$jadwal_latihan')";

        if (mysqli_query($koneksi, $sql_add)) {
            $_SESSION['message'] = 'Jadwal berhasil ditambahkan!';
        } else {
            $_SESSION['error'] = 'Error: ' . mysqli_error($koneksi);
        }
        header("Location: Jadwal.php");
        exit();
    } elseif ($action == 'edit_jadwal') {
        $id_jadwal = $_POST['id_jadwal'] ?? '';
        $pelatih_id = $_POST['pelatih_id'] ?? $aktorId;
        $nama_latihan = $_POST['nama_latihan'] ?? '';
        $jenis_latihan = $_POST['jenis_latihan'] ?? '';
        $deskripsi_latihan = $_POST['deskripsi_latihan'] ?? '';
        $jadwal_latihan = $_POST['jadwal_latihan'] ?? '';

        $sql_edit = "UPDATE jadwal_latihan SET pelatih_id='$pelatih_id', nama_latihan='$nama_latihan', jenis_latihan='$jenis_latihan', deskripsi_latihan='$deskripsi_latihan', jadwal_latihan='$jadwal_latihan' WHERE id_jadwal='$id_jadwal'";

        if (mysqli_query($koneksi, $sql_edit)) {
            $_SESSION['message'] = 'Jadwal berhasil diupdate!';
        } else {
            $_SESSION['error'] = 'Error: ' . mysqli_error($koneksi);
        }
        header("Location: Jadwal.php");
        exit();
    } elseif ($action == 'delete_jadwal') {
        $id_jadwal = $_POST['id_jadwal'] ?? '';

        $sql_delete = "DELETE FROM jadwal_latihan WHERE id_jadwal='$id_jadwal'";

        if (mysqli_query($koneksi, $sql_delete)) {
            $_SESSION['message'] = 'Jadwal berhasil dihapus!';
        } else {
            $_SESSION['error'] = 'Error: ' . mysqli_error($koneksi);
        }
        header("Location: Jadwal.php");
        exit();
    }
}

// Query untuk menampilkan jadwal latihan berdasarkan pelatih_id yang sedang login
$sql = "SELECT jl.*, a.nama AS nama_pelatih FROM jadwal_latihan jl JOIN aktor a ON jl.pelatih_id = a.id_aktor WHERE jl.pelatih_id = $aktorId";
$hasil = mysqli_query($koneksi, $sql);

// Query untuk mengambil semua aktor dengan role Admin/Pelatih untuk dropdown (opsional, tergantung kebutuhan)
$sql2 = "SELECT id_aktor, nama FROM aktor WHERE role = 'Admin'";
$tampil2 = mysqli_query($koneksi, $sql2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Jadwal</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />
    <link rel="stylesheet" href="../../dist/css/fullcalendar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="../../dist/js/jquery.min.js"></script>
    <script src="../../dist/js/moment.min.js"></script>
    <script src="../../dist/js/fullcalendar.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-static-top" style="background-color: #818992;position: fixed; width: 100%; top:0;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #fff"></i></a>
                </li>
            </ul>
        </nav>
        <?php
        $aktorr = $_SESSION['id_aktor'];
        $conn = mysqli_connect("localhost", "root", "", "jokotole");
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasill = mysqli_query($conn, $sql);
        $bariss = mysqli_fetch_assoc($hasill);
        ?>
        <?php include 'siderbar/sidebar.php'; ?>

        <div class="content-wrapper" style="background-color: #BED2BE;">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #000;margin-top:70px;"><b>Jadwal Latihan</b></h1>
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
                                    <?php if (isset($_SESSION['message'])): ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['error'])): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>

                                    <div class="box-header mb-3" style="display: flex; justify-content: space-between; align-items: center;">
                                        <div class="button-container">
                                            <button type="button" class="btn btn-primary" id="openModalButton">Tambah Jadwal</button>
                                        </div>
                                        <div class="label-input-container">
                                            <label>Search:</label>
                                            <input type="search" id="inPutnamalatihan" onkeyup="myFunctionfunc()" class="form-control" data-table="table-bordered" placeholder="Cari Nama Latihan" />
                                        </div>
                                    </div>
                                    
                                    <div class="box-body">
                                        <table class="table" id="taBeljadwallatihan" style="text-align: center;">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Jenis</th>
                                                    <th>Jadwal Latihan</th>
                                                    <th>Nama Latihan</th>
                                                    <th>Deskripsi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                mysqli_data_seek($hasil, 0); 
                                                while ($baris = mysqli_fetch_assoc($hasil)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $baris['jenis_latihan'] ?></td>
                                                        <td><?php echo $baris['jadwal_latihan'] ?></td>
                                                        <td><?php echo $baris['nama_latihan'] ?></td>
                                                        <td><?php echo $baris['deskripsi_latihan'] ?></td>
                                                        <td>
                                                            <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#eventModal" data-id_jadwal="<?php echo $baris['id_jadwal']; ?>" data-jenis_latihan="<?php echo $baris['jenis_latihan']; ?>" data-jadwal_latihan="<?php echo $baris['jadwal_latihan']; ?>" data-nama_latihan="<?php echo $baris['nama_latihan']; ?>" data-deskripsi_latihan="<?php echo $baris['deskripsi_latihan']; ?>" data-pelatih_id="<?php echo $baris['pelatih_id']; ?>"><i class="fas fa-pencil-alt"></i></button>
                                                            <button class="btn btn-danger btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id_jadwal="<?php echo $baris['id_jadwal']; ?>"><i class="fas fa-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                <?php }; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div id="eventModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="modalTitle"></h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="eventForm" action="" method="POST">
                                                        <input type="hidden" name="action" id="action_input">
                                                        <input type="hidden" name="id_jadwal" id="Event_id_jadwal">
                                                        <input type="hidden" name="pelatih_id" id="event_pelatih_id" value="<?php echo $aktorId; ?>">
                                                        <div class="form-group">
                                                            <label for="Event_nama_latihan">Nama Latihan:</label>
                                                            <input type="text" class="form-control" id="Event_nama_latihan" name="nama_latihan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Event_jenis_latihan">Jenis Latihan:</label>
                                                            <input type="text" class="form-control" id="Event_jenis_latihan" name="jenis_latihan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Event_deskripsi_latihan">Deskripsi Latihan:</label>
                                                            <textarea class="form-control" id="Event_deskripsi_latihan" name="deskripsi_latihan" required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="eventStartDate">Date:</label>
                                                            <input type="date" class="form-control eventStartPicker" id="eventStartDate" name="jadwal_latihan" required>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus jadwal latihan ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="" method="POST" id="deleteForm">
                                                        <input type="hidden" name="action" value="delete_jadwal">
                                                        <input type="hidden" name="id_jadwal" id="delete_id_jadwal">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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

    <script>
        $(document).ready(function() {
            // Menampilkan modal tambah jadwal
            $('#openModalButton').on('click', function() {
                $('#modalTitle').text('FORM TAMBAH JADWAL LATIHAN');
                $('#action_input').val('add_jadwal');
                $('#submitButton').text('Simpan');
                $('#Event_id_jadwal').val('');
                $('#Event_nama_latihan').val('');
                $('#Event_jenis_latihan').val('');
                $('#Event_deskripsi_latihan').val('');
                $('#eventStartDate').val('');
                // Menampilkan modal
                $('#eventModal').modal('show');
            });

            // Menampilkan modal edit dengan data yang sudah ada
            $('.edit-btn').on('click', function() {
                const id_jadwal = $(this).data('id_jadwal');
                const jenis_latihan = $(this).data('jenis_latihan');
                const jadwal_latihan = $(this).data('jadwal_latihan');
                const nama_latihan = $(this).data('nama_latihan');
                const deskripsi_latihan = $(this).data('deskripsi_latihan');
                
                $('#modalTitle').text('FORM EDIT JADWAL LATIHAN');
                $('#action_input').val('edit_jadwal');
                $('#submitButton').text('Edit');
                
                $('#Event_id_jadwal').val(id_jadwal);
                $('#Event_nama_latihan').val(nama_latihan);
                $('#Event_jenis_latihan').val(jenis_latihan);
                $('#Event_deskripsi_latihan').val(deskripsi_latihan);
                $('#eventStartDate').val(jadwal_latihan);
            });

            // Menampilkan modal konfirmasi hapus
            $('.delete-btn').on('click', function() {
                const id_jadwal = $(this).data('id_jadwal');
                $('#delete_id_jadwal').val(id_jadwal);
            });

            // Fungsi Pencarian
            function myFunctionfunc() {
                var input, filter, table, tr, td, i, txtValue;
                input = document.getElementById("inPutnamalatihan");
                filter = input.value.toUpperCase();
                table = document.getElementById("taBeljadwallatihan");
                tr = table.getElementsByTagName("tr");
                for (i = 0; i < tr.length; i++) {
                    td = tr[i].getElementsByTagName("td")[3]; // Kolom Jenis Latihan
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

            // Memanggil fungsi pencarian saat input berubah
            $('#inPutnamalatihan').on('keyup', myFunctionfunc);
        });
    </script>

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