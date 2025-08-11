<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
if (isset($_POST['filter_tgl'])) {
    $mulai = $_POST['tgl_mulai'];
    $selesai = $_POST['tgl_selesai'];

    if ($mulai != null || $selesai != null) {
        $sql = "SELECT id_pembayaran, nama, tanggal_bayar, nominal_bayar, deadline_pembayaran, status_bayar 
      FROM pembayaran_spp m, aktor p where m.murid_id=p.id_aktor and deadline_pembayaran between '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY)
      order by deadline_pembayaran, nama";
    } else if ($mulai != null) {
        $sql = "SELECT id_pembayaran, nama, tanggal_bayar, nominal_bayar, deadline_pembayaran, status_bayar 
    FROM pembayaran_spp m, aktor p 
    WHERE m.murid_id=p.id_aktor 
    AND deadline_pembayaran >= '$mulai'
    ORDER BY deadline_pembayaran, nama";
    } else if ($selesai != null) {
        $sql = "SELECT id_pembayaran, nama, tanggal_bayar, nominal_bayar, deadline_pembayaran, status_bayar 
    FROM pembayaran_spp m, aktor p 
    WHERE m.murid_id=p.id_aktor 
    AND deadline_pembayaran <= DATE_ADD('$selesai', INTERVAL 1 DAY)
    ORDER BY deadline_pembayaran, nama";
    } else {
        $sql = "SELECT id_pembayaran, nama, tanggal_bayar, nominal_bayar, deadline_pembayaran, status_bayar 
      FROM pembayaran_spp m, aktor p where m.murid_id=p.id_aktor order by deadline_pembayaran, nama";
    }
} else {
    $sql = "SELECT id_pembayaran, nama, tanggal_bayar, nominal_bayar, deadline_pembayaran, status_bayar 
      FROM pembayaran_spp m, aktor p where m.murid_id=p.id_aktor order by deadline_pembayaran, nama";
}

$hasil = mysqli_query($koneksi, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Pembayaran SPP</title>

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
    <link rel="stylesheet" href="../../dist/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        *::-webkit-scrollbar {
            display: none;
        }

        .tglcari {
            display: flex;
            justify-content: space-between;
        }

        .tglcari input {
            margin-right: 10px;
        }
    </style>
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
                            <h1 style="color: #000;margin-top:70px;"><b>Informasi Pembayaran SPP</b></h1>
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
                                    <div class="row mb-1">
                                        <div class="col-md-5">
                                            <form method="post" class="tglcari mb-3">
                                                <div class="input-group">
                                                    <input class="form-control" type="date" name='tgl_mulai'>
                                                    <input class="form-control" type="date" name='tgl_selesai'>
                                                    <button class="btn btn-primary " type="submit" name="filter_tgl">Filter</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-4 ml-auto">
                                            <div class="cari input-group">
                                                <input class="form-control" type="search" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">
                                                <button class="btn btn-success"><i class="bi bi-search"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <table class="table" id="taBelinventaris" style="text-align: center;">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Murid</th>
                                                    <th>Bulan</th>
                                                    <th>Tanggal Bayar</th>
                                                    <th>Nominal</th>
                                                    <th>Deadline Bayar</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                while ($baris = mysqli_fetch_assoc($hasil)) {
                                                ?>
                                                    <?php $i = 1; ?>
                                                    <?php foreach ($hasil as $baris) : ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $baris['nama']; ?></td>
                                                            <td><?php
                                                                // menampilkan data bulan dan tahun berupa teks
                                                                $formattedDate = date('F Y', strtotime($baris['deadline_pembayaran']));
                                                                echo $formattedDate; ?></td>
                                                            <td><?php echo $baris['tanggal_bayar']; ?></td>
                                                            <td><?php echo "Rp" . number_format($baris['nominal_bayar'], 0, ',', '.') ?></td>
                                                            <td><?php echo $baris['deadline_pembayaran']; ?></td>
                                                            <td><?php echo ucwords(strtolower($baris['status_bayar'])); ?></td>
                                                            <?php $i++; ?>
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