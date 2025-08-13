<?php
$koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');
$sql = "SELECT * FROM inventaris i";
$hasil = mysqli_query($koneksi, $sql);
?>

<?php
session_start();
require_once("../Koneksi.php");

if (isset($_POST['hapus'])) {
    $id = $_POST['id_inventaris'];

    if (!empty($id)) {
        $query = "DELETE FROM inventaris WHERE id_inventaris=$id";
        $queryact = mysqli_query($conn, $query);
        if ($queryact) {
            header("Location: Inventaris.php"); // Redirect ke halaman Inventaris setelah penghapusan berhasil
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
    <title>Super Admin | Inventaris</title>

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
        $conn = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasill = mysqli_query($conn, $sql);
        $bariss = mysqli_fetch_assoc($hasill);
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
                            <h1 style="color: #fff;margin-top:70px;"><b>Inventaris Barang</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal" role="document">
                    <div class="modal-content shadow">
                        <div class="modal-header bg-light shadow-sm" style="background-color: #BED2BE !important;">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="image text-center">
                                            <img src="../../dist/img/Jokotole.png" width="200" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="modal-body">
                                            Apakah anda yakin mencetak data inventaris ini?
                                            <hr>
                                            <button type="button" class="btn bg-navy" data-dismiss="modal">Batal</button>
                                            <a href="../Print_Inventaris.php" target="blank"><button type="button" onclick="refresh()" href="#" id="confirmBtn" class="btn bg-olive">Ya, Lanjutkan</button></a>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer shadow-sm" style="background-color: #BED2BE;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">
                                    <div class="box-header mb-3" style="display: flex; justify-content: space-between; align-items: center;">
                                        <div>
                                            <a href="Tambah_Inventaris.php" class="btn bg-olive"><i class="fa fa-plus-circle"></i> Tambah Barang</a>
                                            <button type="button" name="simpan" class="btn bg-maroon" data-toggle="modal" data-target="#myModal">
                                                <i class="fa fa-print"></i> Cetak
                                            </button>
                                        </div>
                                        <div class="label-input-container">
                                            <label>Search:</label>
                                            <input type="search" id="inPutbarang" onkeyup="myFunctionfunc()" class="form-control" data-table="table-bordered" placeholder="Cari Barang" />
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                     
                                    <div class="box-body">
                                        <table class="table table-bordered table-striped" id="taBelinventaris" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah Barang</th>
                                                    <th>Modify</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                while ($baris = mysqli_fetch_assoc($hasil)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $no++ ?></td>
                                                        <td><?php echo $baris['nama_barang'] ?></td>
                                                        <td><?php echo $baris['jumlah_barang'] ?></td>
                                                        <td style="display: flex; align-items: center; justify-content:center;">
                                                            <a href="Edit_Inventaris.php?id=<?php echo $baris['id_inventaris']; ?>" class="btn btn-sm btn-info" style="margin-right: 10px;"><i class="fa fa-pencil-square-o"></i></a>
                                                            <form method="post" action="Inventaris.php">
                                                                <input type="hidden" name="id_inventaris" value="<?php echo $baris['id_inventaris']; ?>">
                                                                <button type="submit" name="hapus" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus ini ?')">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </form>
                                                        </td>

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

        <footer class="main-footer" style="background-color: #292C30">
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
    <script>
        $('#confirmationModal').modal('hide');

        function refresh() {
            var newWindow = window.open('../Print_Inventaris.php', 'blank');
            window.location.reload();
        }
    </script>

</body>

</html>