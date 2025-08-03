<?php
    $koneksi = mysqli_connect("localhost", "root", "", "jokotole");
    
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa | Evaluasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../dist/css/dimas.css">
    <style>
        img { 
            border: 2px solid; 
            border-radius: 100%; 
            margin-right: auto; 
            margin-left: auto
        }
        .conten {
            position: relative;
            margin-right: auto; 
            margin-left: auto;
            width: 50%;
        }
        .image {
            opacity: 1;
            display: block;
            width: 50% ;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }
        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%)
        }
        .conten:hover .image {
            opacity: 0.3;
        }
        .conten:hover .middle {
            opacity: 1;
        }

        th, td, table {
            color: black;
            border: 1px solid black;
        }

        th {
            padding: 10px 5px;
        }

        thead {
            background-color: gray;
        }

        thead, tbody {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="pembungkus">
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

        <div class="main-content">
            <h1 style="color: white;">Hasil Evaluasi</h1>
            <div class="container">
                <div class="card-body">
                    <div class="col-lg-12 mb-4 px-lg-2 p-3" style="margin-right:auto; margin-left: auto">
                        <div class="card mb-4 border-2 shadow">
                            <div class="row g-0 p-3 align-items-center">

                                <table style="border: 1px solid black;">
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
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>