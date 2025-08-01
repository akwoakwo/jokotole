<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql2 = "SELECT * FROM aktor WHERE role = 'Admin'";
$tampil2 = mysqli_query($koneksi, $sql2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Jadwal</title>

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
    <link rel="stylesheet" href="../../dist/css/fullcalendar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="../../dist/js/jquery.min.js"></script>
    <script src="../../dist/js/moment.min.js"></script>
    <script src="../../dist/js/fullcalendar.min.js"></script>
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
        <aside class="main-sidebar sidebar-light-primary elevation-4" style="background-color: #fff;color:white;">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../../dist/img/<?php echo $bariss['foto'] ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $bariss['nama'] ?></a>
                        <a href="#" style="font-size: 12px;"><i class="fa fa-circle text-success"></i> Admin</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="Dashboard_Admin.php" class="nav-link">
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
                            <a href="Merchandise.php" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart "></i>
                                <p>
                                    Merchandise
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Penjurusan_Prestasi.php" class="nav-link">
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
                            <a href="Materi.php" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Materi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Evaluasi.php" class="nav-link">
                                <i class="nav-icon fas fa-info "></i>
                                <p>
                                    Evaluasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Data_Siswa.php" class="nav-link">
                                <i class="nav-icon fas fa-graduation-cap "></i>
                                <p>
                                    Data Siswa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Verifikasi_Absen_Siswa.php" class="nav-link">
                                <i class="nav-icon fas fa-check "></i>
                                <p>
                                    Verifikasi Absensi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Jadwal.php" class="nav-link">
                                <i class="nav-icon fas fa-clock-o "></i>
                                <p>
                                    Jadwal
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
                            <a href="struktur.php" class="nav-link">
                                <i class="nav-icon 	fas fa-sitemap"></i>
                                <p>
                                    Struktur Organisasi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="rekomendasilomba_Admin.php" class="nav-link">
                                <i class="nav-icon fa fa-handshake-o"></i>
                                <p>
                                    Rekomendasi Lomba
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pengajuan_lomba.php" class="nav-link">
                                <i class="nav-icon fa fa-trophy"></i>
                                <p>
                                    Pengajuan Lomba
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="Pengaturan.php" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Pengaturan
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
        <div class="content-wrapper" style="background-color: #BED2BE;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #000;margin-top:70px;"><b>Jadwal</b></h1>
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
                                    <button class="btn bg-olive" style="margin-left: 70rem;"><i class="fa fa-plus-circle" id="openModalButton"></i></button>
                                    <div id="calendar"></div>
                                    <!-- <button id="openModalButton" class="btn"><img src="../../dist/img/blackplus.png" alt="Ikon Kustom"></button> -->
                                    <!-- <button id="openModalButton" type="button" class="btn btn-dark">
                                        <img src="../../dist/img/blackplus.png" alt="Ikon Kustom">
                                    </button> -->

                                    <div id="eventModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="Add">FORM TAMBAH JADWAL LATIHAN </h4>
                                                    <h4 class="modal-title" id="Edit">FORM EDIT JADWAL LATIHAN</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="eventForm">
                                                        <div class="form-group">
                                                            <label for="Event_nama_latihan">Nama Latihan:</label>
                                                            <input type="text" class="form-control" id="Event_nama_latihan" name="Event_nama_latihan">
                                                        </div>

                                                        <div class="form-group" id="Event_pel_id">
                                                            <label for="Event_pelatih_id">Nama Pelatih:</label>
                                                            <select class="form-select" aria-label="Default select example" id="Event_pelatih_id" name="Event_pelatih_id">
                                                                <option selected>PILIH NAMA PELATIH</option>
                                                                <?php
                                                                while ($baris1 = mysqli_fetch_assoc($tampil2)) {
                                                                ?>
                                                                    <option value="<?php echo $baris1["id_aktor"]; ?>"><?php echo $baris1["nama"]; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Event_jenis_latihan">Jenis Latihan:</label>
                                                            <input type="text" class="form-control" id="Event_jenis_latihan" name="Event_jenis_latihan">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="Event_deskripsi_latihan">Deskripsi Latihan:</label>
                                                            <textarea class="form-control" id="Event_deskripsi_latihan" name="Event_deskripsi_latihan"></textarea>
                                                        </div>
                                                        <div class="form-group" hidden>
                                                            <textarea class="form-control" id="Event_id_jadwal" name="Event_id_jadwal"></textarea>
                                                        </div>
                                                        <div class="form-group" hidden>
                                                            <textarea class="form-control" id="event_pelatih_id" name="event_pelatih_id"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="eventStartDate">Date:</label>
                                                            <input type="date" class="form-control eventStartPicker" id="eventStartDate" name="eventStartDate">
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" id="closeModal">Cancel</button>
                                                    <button type="button" class="btn btn-primary" id="saveEvent">Save</button>

                                                    <button type="button" style="display: none;" class="btn btn-primary" id="EditEvent">Edit</button>

                                                    <button type="button" class="btn btn-danger" id="deleteEvent">Delete</button>
                                                </div>
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

    <script>
        //Persiapa JQuery
        $(document).ready(function() {
            $('#openModalButton').click(function() {
                $('#eventModal').modal('show');
                $('#EditEvent').hide();
                $('#Edit').hide();
                $('#saveEvent').show();
                $('#Add').show();
                $('#Event_pel_id').show();
            });
            var calendar = $('#calendar').fullCalendar({
                //izinkan tabel bisa di edit
                editable: true,
                header: {
                    left: 'prev ,next ,today',
                    center: 'title',
                    right: 'month, agendaWeek ,agendaDay'
                },
                //tampilkan data dari DB
                events: "../tampil2.php",
                selectable: true,
                selectHelper: true,
                eventClick: function(event) {
                    // Handle event editing here
                    $('#eventModal').modal('show');
                    $('#EditEvent').show();
                    $('#Edit').show();
                    $('#saveEvent').hide();
                    $('#Add').hide();
                    $('#Event_pel_id').hide();
                    $('#Event_nama_latihan').val(event.nama_latihan);
                    $('#Event_jenis_latihan').val(event.title.split('Latihan : ')[1].split('\n')[0].trim());
                    $('#Event_nama_pelatih').val(event.title.split('Pelatih : ')[1].split('\n')[0].trim());
                    $('#Event_deskripsi_latihan').val(event.deskripsi_latihan);
                    $('#Event_id_jadwal').val(event.id_jadwal);
                    $('#event_pelatih_id').val(event.pelatih_id);
                    $('#eventStartDate').val(event.start.format('YYYY-MM-DD'));
                    // Attach the event ID to the save button to identify which event to update

                },
                eventDrop: function(event) {
                    var jadwal_latihan = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var id_jadwal = event.id_jadwal;
                    $.ajax({
                        url: "../update21.php",
                        type: "POST",
                        data: {
                            jadwal_latihan: jadwal_latihan,
                            id_jadwal: id_jadwal
                        },
                        success: function() {
                            $('#eventModal').modal('hide');
                            calendar.fullCalendar('refetchEvents');
                            alert('Update sukses....!');
                        }
                    });


                }
            });
            $('#saveEvent').click(function() {
                var nama_latihan = $('#Event_nama_latihan').val();
                var pelatih_id = $('#Event_pelatih_id').val();
                var jenis_latihan = $('#Event_jenis_latihan').val();
                var deskripsi_latihan = $('#Event_deskripsi_latihan').val();
                var jadwal_latihan = $('#eventStartDate').val();
                $.ajax({
                    url: "../simpan2.php",
                    type: "POST",
                    data: {
                        nama_latihan: nama_latihan,
                        pelatih_id: pelatih_id,
                        jenis_latihan: jenis_latihan,
                        deskripsi_latihan: deskripsi_latihan,
                        jadwal_latihan: jadwal_latihan
                    },
                    success: function() {
                        $('#eventModal').modal('hide');
                        calendar.fullCalendar('refetchEvents');
                        alert('Simpan sukses....!');
                    }
                });
            });
            $('#EditEvent').click(function() {
                var id_jadwal = $('#Event_id_jadwal').val();
                var nama_latihan = $('#Event_nama_latihan').val();
                var jenis_latihan = $('#Event_jenis_latihan').val();
                var deskripsi_latihan = $('#Event_deskripsi_latihan').val();
                var jadwal_latihan = $('#eventStartDate').val();
                var pelatih_id = $('#event_pelatih_id').val();
                // If eventId exists, it's an edit operation
                $.ajax({
                    url: "../update2.php",
                    type: "POST",
                    data: {
                        id_jadwal: id_jadwal,
                        pelatih_id: pelatih_id,
                        nama_latihan: nama_latihan,
                        jenis_latihan: jenis_latihan,
                        deskripsi_latihan: deskripsi_latihan,
                        jadwal_latihan: jadwal_latihan
                    },
                    success: function() {
                        $('#eventModal').modal('hide');
                        calendar.fullCalendar('refetchEvents');
                        alert('Edit sukses....!');
                        location.reload();
                    }
                });
            });

            $('#deleteEvent').click(function() {
                var id_jadwal = $('#Event_id_jadwal').val();

                if (confirm('Apakah Anda yakin ingin menghapus peristiwa ini?')) {
                    $.ajax({
                        url: "../hapus.php", // Ganti dengan URL yang sesuai
                        type: "POST",
                        data: {
                            id_jadwal: id_jadwal
                        },
                        success: function() {
                            $('#eventModal').modal('hide');
                            calendar.fullCalendar('refetchEvents');
                            alert('Hapus sukses....!');
                            location.reload();
                        }
                    });
                }
            });

            //event ketika ingin update jadwal dengan drag and drop

            $('#eventStartPicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });

            $('#eventEndPicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });
        $('#closeModal').click(function() {
            $('#eventModal').modal('hide');
            location.reload();
        });
    </script>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
    <!-- Bootstrap 4 -->
    <!-- <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- overlayScrollbars -->
    <!-- <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
    <!-- AdminLTE App -->
    <!-- <script src="../../dist/js/adminlte.min.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../../dist/js/demo.js"></script> -->
</body>

</html>