<?php
session_start();
$koneksi=mysqli_connect("localhost","root","","jokotole");
$nama = $_SESSION['nama'];
$sql="SELECT id_pembayaran, nama, tanggal_bayar, nominal_bayar, deadline_pembayaran, status_bayar 
FROM pembayaran_spp m, aktor p where m.murid_id=p.id_aktor AND p.nama = '$nama' order by deadline_pembayaran, nama";
$hasil=mysqli_query($koneksi,$sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siswa | Pembayaran SPP</title>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
    *::-webkit-scrollbar{
	    display: none;
    }
    .tglcari{
      display:flex;
      justify-content: space-between;
    }
    .tglcari input{
    margin-right:10px;
    }
    </style>
</head>
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
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #3B4045">
            <?php
            
            if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
                header("Location: index.php");
            }
            $aktorr = $_SESSION['id_aktor'];
            $conn = mysqli_connect("localhost", "root", "", "jokotole");
            $sql = "SELECT * FROM aktor WHERE id_aktor = $aktorr";
            $hasill = mysqli_query($conn, $sql);
            $bariss = mysqli_fetch_assoc($hasill);
            ?>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/<?php echo $bariss['foto'] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $bariss['nama'] ?></a>
                        <a href="#" style="font-size: 12px;"><i class="fa fa-circle text-success"></i> Murid</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="Dashboard_SuperAdmin.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Profil_Perguruan.php" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Profil Perguruan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Kelola_Merchandise.php" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart "></i>
                                <p>
                                    Merchandise
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-road"></i>
                                <p>
                                    Penjurusan Prestasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Kelayakan.php" class="nav-link">
                                <i class="nav-icon fas fa-percent"></i>
                                <p>
                                    Kelayakan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Inventaris.php" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Inventaris
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Pesan.php" class="nav-link">
                                <i class="nav-icon fas fa-envelope "></i>
                                <p>
                                    Kotak Masuk
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="galeriprestasi.php" class="nav-link">
                            <i class="nav-icon fas fa-trophy"></i>
                                <p>
                                    Galeri Prestasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="spp.php" class="nav-link">
                            <i class="nav-icon fas fa-receipt"></i>
                                <p>
                                    Informasi SPP
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="strukturorganisasi.php" class="nav-link">
                            <i class="nav-icon 	fas fa-sitemap"></i>
                                <p>
                                    Struktur Organisasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../logout.php" class="nav-link">
                                <i class="nav-icon fas fa fa-sign-out"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #18191A;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #fff;margin-top:70px;"><b>INFORMASI PEMBAYARAN SPP</b></h1>
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
                            <div class="card mb-4">

                                <div class="card-body">
                                <div class="row mb-3 justify-content-end">
                                <div class="col-md-4">
                                <div class="input-group">
                                    <input class="form-control" type="search" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
                                    <button class="btn btn-success"><i class="bi bi-search"></i></button>
                                </div>
                                </div>
                                </div>
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table class="table table-bordered table-striped" id="taBelinventaris" style="text-align: center;">
                                            <thead>
                                                <tr>
                                                <th>ID</th>
                                                <th>NAMA_MURID</th>
                                                <th>BULAN</th>
                                                <th>TANGGAL_BAYAR</th>
                                                <th>NOMINAL</th>
                                                <th>DEADLINE_BAYAR</th>
                                                <th>STATUS</th>
                                                
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                
                                                while ($baris = mysqli_fetch_assoc($hasil)) {
                                                ?>
                                                    <?php $i = 1;?>
                                                    <?php foreach ($hasil as $baris) : ?>
                                                    <tr>
                                                    <td><?php echo $i ;?></td>
                                                    <td><?php echo $baris['nama'];?></td>
                                                    <td><?php
                                                        // menampilkan data bulan dan tahun berupa teks
                                                        $formattedDate = date('F Y', strtotime($baris['deadline_pembayaran']));
                                                        echo $formattedDate;?></td>
                                                        <td><?php echo $baris['tanggal_bayar'];?></td>
                                                        <td><?php echo $baris['nominal_bayar'];?></td>
                                                        <td><?php echo $baris['deadline_pembayaran'];?></td>
                                                        <td><?php echo $baris['status_bayar'];?></td>
                                                        
                                                    <?php $i++;?>
                                                    <?php endforeach; ?> 
                                                    </tr>
                                                <?php }; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card -->
                            <br><br>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer" style="background-color: #292C30; position:fixed; bottom:0; width: 100%;">
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

    <script type="text/javascript" src="../../dist/js/pages/search.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Script Fitur pencarian-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementsByTagName("table")[0];
  tr = table.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
        td1 = tr[i].getElementsByTagName("td")[1]; // Use index 1 for the second column
        td2 = tr[i].getElementsByTagName("td")[2]; // Use index 2 for the third column
        if (td1 || td2) {
            txtValue1 = td1.textContent || td1.innerText;
            txtValue2 = td2.textContent || td2.innerText;
            if (txtValue1.toUpperCase().indexOf(filter) > -1 || txtValue2.toUpperCase().indexOf(filter) > -1) {
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