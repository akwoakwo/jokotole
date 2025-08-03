<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT id_prestasi, nama_prestasi, tingkat_prestasi, deskripsi_prestasi, foto_prestasi, nama 
FROM galeri_prestasi m, aktor p where m.murid_id=p.id_aktor";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin | Galeri Prestasi</title>

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
        *::-webkit-scrollbar {
            display: none;
        }

        .deskripsi {
            text-align: left;
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
                            <h1 style="color: #fff;margin-top:70px;"><b>Galeri Prestasi</b></h1>
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
                                    <div class="row mb-3">
                                        <div class="col-md-8">
                                            <a href="tambahgaleri.php" class="btn btn-success">Tambah</a>
                                        </div>
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
                                                    <th>NAMA_PRESTASI</th>
                                                    <th>TINGKAT</th>
                                                    <th>DESKRIPSI</th>
                                                    <th>FOTO PRESTASI</th>
                                                    <th>MURID</th>
                                                    <th>ACTION</th>
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
                                                            <td><?php echo $baris['nama_prestasi']; ?></td>
                                                            <td><?php echo $baris['tingkat_prestasi']; ?></td>
                                                            <td class="deskripsi"><?php echo $baris['deskripsi_prestasi']; ?></td>
                                                            <td><img style="max-width: 120px; max-height: 80px;" src="../../dist/img/<?php echo $baris['foto_prestasi']; ?>" class="img-fluid"></td>
                                                            <td><?php echo $baris['nama']; ?></td>
                                                            <!--button edit dan hapus-->
                                                            <td class="action-icons">
                                                                <a href="ubahgaleri.php?id=<?php echo $baris['id_prestasi']; ?>" class="btn btn-sm btn-primary mb-2"><i class="bi bi-pencil-square"></i></a>
                                                                <a href="hapusgaleri.php?id=<?php echo $baris['id_prestasi']; ?>" onClick="return confirm('Yakin?')" class="btn btn-danger btn-sm "><i class="bi bi-trash-fill"></i></a>
                                                            </td>
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
                td = tr[i].getElementsByTagName("td")[1];
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