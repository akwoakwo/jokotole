<?php
    $koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');
    
    session_start();
    $id_murid = $_SESSION['id_aktor'];

    //melakukan query menampilkan data
    $data_murid = "SELECT aktor.*, jurusan.nama_jurusan FROM aktor LEFT JOIN jurusan ON aktor.jurusan_id = jurusan.id_jurusan WHERE aktor.id_aktor = $id_murid";
    $hasil = mysqli_query($koneksi, $data_murid);
    $row = mysqli_fetch_assoc($hasil);

    $data_murid = "SELECT aktor.*, jurusan.nama_jurusan FROM aktor LEFT JOIN jurusan ON aktor.jurusan_id = jurusan.id_jurusan WHERE aktor.id_aktor = $id_murid";
    $tampil = mysqli_query($koneksi, $data_murid);
    
    // Ambil data dari tampil query
    $row = mysqli_fetch_assoc($tampil);

    //melakukan query menampilkan data
    $query_evaluasi = "SELECT nama, jadwal_latihan, jenis_latihan, ulasan_pelatih from evaluasi_diri inner join jadwal_latihan on evaluasi_diri.jadwal_latihan_id = jadwal_latihan.id_jadwal inner join aktor on aktor.id_aktor = evaluasi_diri.pelatih_id";
    $hasil_evaluasi = mysqli_query($koneksi, $query_evaluasi);

    $no = 1;

    // Ambil data aktor untuk sidebar
$aktorr = $_SESSION['id_aktor'];
$sqlAktor = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
$hasilAktor = mysqli_query($koneksi, $sqlAktor);
$bariss = mysqli_fetch_assoc($hasilAktor);

$warna = $bariss['jurusan_id'];
if ($warna == '1') {
    $background = 'background-color:seagreen;';
    $namajurusan = 'Belum Menentukan Jurusan';
}
if ($warna == '2') {
    $background = 'background-color:tomato;';
    $namajurusan = 'Jurusan Tanding';
}
if ($warna == '3') {
    $background = 'background-color:steelblue;';
    $namajurusan = 'Jurusan Seni';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siswa | Evaluasi Latihan</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />
    <link href="../../dist/css/style.css" rel="stylesheet">
    
    <style>
        .table thead th {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-static-top" style="background-color: #292C30;position: fixed; width: 100%; top:0;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #fff"></i></a>
                </li>
            </ul>
        </nav>
        <?php include 'sidebar/sidebar.php'; ?>

        <div class="content-wrapper" style="background-color: #18191A;">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #fff;margin-top:70px;"><b>Evaluasi Latihan</b></h1>
                        </div>
                    </div>
                </div></section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="box-header mb-3" style="display: flex; justify-content: flex-end; align-items: center;">
                                        <div class="label-input-container">
                                            <label>Search:</label>
                                            <input type="search" id="inPutnamalatihan" onkeyup="myFunctionfunc()" class="form-control" data-table="table-bordered" placeholder="Cari Nama Latihan" />
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <table class="table table-bordered table-striped" id="taBeljadwalatihan" style="text-align: center;">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Pelatih</th>
                                                    <th>Jadwal Latihan</th>
                                                    <th>Nama Teknik</th>
                                                    <th style="width: 500px;">Deskripsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while($data_baru = mysqli_fetch_assoc($hasil_evaluasi)){?>
                                                <tr class="kolom">
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $data_baru["nama"]; ?></td>
                                                    <td><?php echo $data_baru["jadwal_latihan"]; ?></td>
                                                    <td><?php echo $data_baru["jenis_latihan"]; ?></td>
                                                    <td style="width: 225px;"><?php echo $data_baru["ulasan_pelatih"]; ?></td>
                                                </tr>
                                                <?php }?>
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            </div>
        <footer class="main-footer" style="background-color: #292C30; position: fixed; bottom: 0; width: 100%;">
            <strong style="color: #fff">Copyright &copy; 2023 <a href="https://localhost:PPL" style="color: #fff;">Jokotole Kodim 0829</a>.</strong>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
            </aside>
        </div>
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>

    <script>
        // Fungsi pencarian
        function myFunctionfunc() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("inPutnamalatihan");
            filter = input.value.toUpperCase();
            table = document.getElementById("taBeljadwalatihan");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4]; // Kolom Nama Latihan ada di indeks ke-4 (indeks dimulai dari 0)
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