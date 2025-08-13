<?php
$koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');
$sql = "SELECT * FROM profile_perguruan pm";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin | Profil Perguruan</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />
    <script type="text/javascript" src="../../dist/js/pages/search.js"></script>
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
        session_start();
        if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
            header("Location: index.php");
        }
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
                            <h1 style="color: #fff;margin-top:70px;"><b>Profil Perguruan</b></h1>
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

                                    <div class="box-header mb-3" style="display: flex; justify-content: space-between; ">
                                        <a href="Edit_Data_Profil_Perguruan.php?id=<?php echo 1; ?>"><button type="button" class="btn btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Profil</button></a>
                                        <div class="label-input-container">
                                            <label>Search:</label>
                                            <input type="search" id="myInput" onkeyup="myFunction()" class="form-control" data-table="table-bordered" placeholder="Mencari..." />
                                        </div>

                                    </div>
                                    <table class="table table-bordered table-striped" id="tabelprofil" style="text-align: center;">
                                        <tbody>
                                            <?php
                                            while ($baris = mysqli_fetch_assoc($hasil)) {
                                            ?>
                                                <tr>
                                                    <th>Sejarah</th>
                                                    <td style="text-align: justify;"><?php echo $baris['sejarah'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Visi-Misi</th>
                                                    <td style="text-align: justify;"><?php echo $baris['visi_misi'] ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Makna Lambang</th>
                                                    <td style="text-align: justify;"><?php echo $baris['arti_lambang'] ?></td>
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

        <footer class="main-footer" style="background-color: #292C30">
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

</body>

</html>