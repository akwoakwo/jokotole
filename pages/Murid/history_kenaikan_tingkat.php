<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM kenaikan_tingkat k";
$hasil = mysqli_query($koneksi, $sql);
?>

<?php
session_start();
require_once("../Koneksi.php");
?>

<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$id_murid = $_SESSION['id_aktor'];
$sql = "SELECT a.nama,k.* FROM kelayakan_naik_tingkat k INNER JOIN aktor a ON k.murid_id = a.id_aktor WHERE murid_id = $id_murid";
// $sql = "SELECT COUNT(*) FROM kelayakan_naik_tingkat WHERE murid_id = SESSION['murid_id']";
// $tampil1 = mysqli_query($koneksi2, $sql1);
$tampil = mysqli_query($koneksi, $sql);

$colorDictionary = array(
    'MERAH1' => 'red',
    'MERAH2' => 'red',
    'COKLAT' => 'brown',
    'HIJAU' => 'green',
    'KUNING1' => 'yellow',
    'KUNING2' => 'yellow',
    'PUTIH' => 'white',
    // Tambahkan warna lainnya sesuai kebutuhan Anda
);
function translateColor($colorName, $colorDictionary)
{
    // Default, jika tidak ada padanan, gunakan nama asli
    $translatedColor = $colorName;

    // Cek apakah nama warna ada dalam kamus
    if (array_key_exists($colorName, $colorDictionary)) {
        $translatedColor = $colorDictionary[$colorName];
    }

    return $translatedColor;
}
$sql1 = "SELECT tingkatan FROM aktor WHERE id_aktor = $id_murid";
// $sql1 = "SELECT tingkatan FROM aktor WHERE id_aktor = SESSION['murid_id']";
$sql2 = "SELECT COUNT(*) AS JUMLAH FROM kelayakan_naik_tingkat WHERE murid_id = $id_murid";
$tampil1 = mysqli_query($koneksi, $sql1);
$tampil2 = mysqli_query($koneksi, $sql2);

// Loop melalui hasil query dan terjemahkan warna
while ($data = mysqli_fetch_array($tampil1)) {
    $namaWarnaBahasaIndonesia = $data['tingkatan'];

    // Dapatkan warna terjemahan
    $translatedColor = translateColor($namaWarnaBahasaIndonesia, $colorDictionary);
}
while ($data1 = mysqli_fetch_array($tampil2)) {
    $counter = $data1['JUMLAH'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Siswa | Riwayat Kenaikan Tingkat</title>

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
    <style>
        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 20rem;
        }
        
        .c1 {
            border: 1px solid black;
            padding-top: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: white;
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 10%;
        }

        .c11 {
            border-radius: 10%;
            padding-top: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: black;
            color: white;
        }

        .c12 {
            text-align: center;
            padding-top: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;

        }

        .c2 {
            border: 1px solid black;
            padding-top: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: <?php echo $translatedColor; ?>;
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-radius: 10%;
        }

        .c21 {
            border-radius: 10%;
            border: 2px solid black;
            padding-top: 0.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;
            background-color: white;
            color: black;
        }

        .c22 {
            text-align: center;
            padding-top: 2.5rem;
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-bottom: 0.5rem;
            color: white;
            text-shadow: 2px 2px 3px #000000;

        }

        .container2 {
            background-color: white;
            margin-top: 0.5rem;
        }

        /* * {
            border: 1px solid black;
        } */
    </style>
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
        $conn = mysqli_connect("localhost", "root", "", "jokotole");
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasill = mysqli_query($conn, $sql);
        $bariss = mysqli_fetch_assoc($hasill);
        ?>

        <?php
        $aktorr = $_SESSION['id_aktor'];
        $koneksi = mysqli_connect("localhost", "root", "", "jokotole");
        $sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
        $hasil = mysqli_query($koneksi, $sql);
        ?>
        <?php
        $baris = mysqli_fetch_assoc($hasil);
        $warna = $baris['jurusan_id'];
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
                            <h1 style="color: #fff;margin-top:70px;"><b>Riwayat Kenaikan Tingkat</b></h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-body">                                     
                                    <div class="box-body">
                                        <div class="container">
                                            <div class="c1">
                                                <div class="c11 text-center d-flex justify-content-center align-items-center">
                                                    <h4>Berapa kali perubahan</h4>
                                                </div>
                                                <div class="c12">
                                                    <h4 style="font-size: 5rem;"><?php echo $counter ?></h4>
                                                </div>
                                            </div>
                                            <div class="c2">
                                                <div class="c21 text-center d-flex justify-content-center align-items-center">
                                                    <h4>Tingkatan Saat ini</h4>
                                                </div>
                                                <div class="c22">
                                                    <h3><?php echo $namaWarnaBahasaIndonesia ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container2" style="border-radius:10%;">
                                                <?php
                                                while ($row = mysqli_fetch_assoc($tampil)) {
                                                    $warnalama = $row['tingkat_lama'];
                                                    $warnabaru = $row['tingkat_baru'];
    
                                                    // Dapatkan warna terjemahan
                                                    $translatedColor1 = translateColor($warnalama, $colorDictionary);
                                                    $translatedColor2 = translateColor($warnabaru, $colorDictionary);
                                                ?>
                                                    <div class="accordion" id="accordionExample">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="headingOne">
                                                                <!-- <button style="background-image: linear-gradient(to right,<?php echo $translatedColor1; ?> , <?php echo $translatedColor2; ?>);width:100%;color:white;text-shadow: 2px 2px 3px #000000;" class="accordion-button-color" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    <?php echo $row['tingkat_lama']; ?> -> <?php echo $row['tingkat_baru']; ?>
                                                                </button> -->
                                                                <button style="background-image: linear-gradient(to right, <?php echo $row['tingkat_old']; ?> , <?php echo $row['tingkat_baru']; ?>);width:100%;color:white;text-shadow: 2px 2px 3px #000000;" class="accordion-button-color my-4" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"> MERAH -> PUTIH </button>
                                                            </h2>
                                                            <div class="d-flex justify-content-center align-items-center">
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <div style="background-color: white;color:black;width:8rem;height:5rem;text-align:center;border: 3px solid black;border-radius:0px 0px 20px 20px">
                                                                            <div style="background-color: black;border-bottom: 5px solid black;height:2rem;color:white;">
                                                                                <p>---Tanggal---</p>
                                                                            </div>
                                                                            <p style="font-size: 0.9rem;padding-top:0.3rem;"><?php echo $row['tanggal_kenaikan']; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div style="background-color: white;color:black;width:35rem;text-align:center;border: 3px solid black;border-radius:0px 0px 20px 20px">
                                                                            <div style="background-color: black;border-bottom: 5px solid black;height:2rem;color:white;">
                                                                                <p>---MATERI YANG DIUJIKAN---</p>
                                                                            </div>
                                                                            <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr;">
                                                                                <div>
                                                                                    <p style="font-size: 0.9rem;padding-top:0.3rem;">-PERTEMUAN-</p>
                                                                                    <p style="font-size: 0.9rem;"><?php echo $row['jumlah_pertemuan']; ?></p>
                                                                                </div>
                                                                                <div>
                                                                                    <p style="font-size: 0.9rem;padding-top:0.3rem;">-HAFAL MATERI-</p>
                                                                                    <p style="font-size: 0.9rem;"><?php echo $row['hafal_materi']; ?></p>
                                                                                </div>
                                                                                <div>
                                                                                    <p style="font-size: 0.9rem;padding-top:0.3rem;">-FISIK-</p>
                                                                                    <p style="font-size: 0.9rem;"><?php echo $row['fisik']; ?></p>
                                                                                </div>
                                                                                <div>
                                                                                    <p style="font-size: 0.9rem;padding-top:0.3rem;">-BELADIRI-</p>
                                                                                    <p style="font-size: 0.9rem;"><?php echo $row['beladiri']; ?></p>
            
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div style="background-color: white;color:black;width:8rem;height:5rem;margin-left:11rem;text-align:center;border: 3px solid black;border-radius:0px 0px 20px 20px">
                                                                            <div style="background-color: black;border-bottom: 5px solid black;height:2rem;color:white;">
                                                                                <p>---PELATIH---</p>
                                                                            </div>
                                                                            <p style="font-size: 0.9rem;padding-top:0.3rem;"><?php echo $row['nama']; ?></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php } ?>
                                            </div>
                                        </div>
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


    <script type="text/javascript" src="../../dist/js/pages/search.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>