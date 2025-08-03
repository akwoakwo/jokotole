<?php

$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
session_start();

$id_murid = $_SESSION['id_aktor'];

if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
}
if (isset($_POST['submit'])) {
    $id_jadwal=$_POST['id_jadwal'];
    $tanggal_absensi =$_POST['tgl_absensi'];
    $resume_materi =$_POST['resume_materi'];

    $sql="INSERT INTO absensi(murid_id,jadwal_latihan_id,tanggal_absensi,resume_materi,status_absensi) VALUES('$id_murid','$id_jadwal','$tanggal_absensi','$resume_materi','belum ACC')";
    $tampil = mysqli_query($koneksi,$sql);
    header('location:Absen.php');
}

$sql = "SELECT jadwal_latihan.jadwal_latihan, absensi.* FROM absensi INNER JOIN jadwal_latihan ON absensi.jadwal_latihan_id = jadwal_latihan.id_jadwal ";
$sql2 = "SELECT * FROM jadwal_latihan";
$tampil = mysqli_query($koneksi, $sql);
$tampil2 = mysqli_query($koneksi, $sql2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa | Absen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com"> -->
    <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="../../dist/css/kel1-2.css">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        .pembungkus {
            display: flex;
            min-height: 100vh;
        }

        /* -------------- CSS Punya Sidebar ------------------ */

        .sidebar {
            background-color: #FFFFFF;
            width: 340px;
            padding: 40px 24px;
            display: flex;
            box-sizing: border-box;
            flex-direction: column;
        }


        .profile {
            display: flex;
            /* background-color: honeydew; */
            box-sizing: border-box;
        }

        .foto {
            flex: 1;
            order: 1;
        }

        .foto img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 1px solid #8f8f8f;
        }

        .description {
            flex: 2;
            order: 2;
            box-sizing: border-box;
            line-height: 5vh;
            padding-top: 10px;
            margin-left: 10px;

        }

        .sidebar .main {
            margin-top: 30px;
        }

        /* .sidebar .list_item{


        .sidebar .main .list_item a {
            font-style: normal;
            font-weight: 600;
            line-height: 16px;
            text-align: center;
            text-decoration: none;
            color: #1F261F;
        }

        .sidebar .main .list_item {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 12px 10px;
            border-radius: 8px;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .sidebar .main .list_item:hover {
            background-color: #7C7D7C;
            transition: all ease-in 0.3s;
        }

        .sidebar .main .list_item a svg {
            margin-right: 5px;
            text-align: center;
        }

        .btn_back a {
            margin-left: 226px;
        }


        /* -------------- CSS Punya Main content ------------------ */

        .main-content {
            background-color: #1F261F;
            flex-grow: 1;
            padding: 30px;
            box-sizing: border-box;
            /* display: grid; */
            /* grid-template-rows: 1fr 9fr; */
        }

        .komp {
            display: grid;
            background-color: #FFFFFF;
            width: auto;
            height: 100px;
            color: #1F261F;
            grid-template-columns: 2fr 2fr;
            border-radius: 20px;
        }

        .komp .isi-komponen1 {
            display: flex;
            /* padding: 25px 30px; */
            /* text-align: center; */
            justify-content: center;
            align-items: center;
        }

        .komp .isi-komponen2 {
            display: grid;
            /* padding: 25px 30px; */
            /* text-align: center; */
            justify-content: center;
            align-items: center;
            justify-items: center;
        }

        .komp_table {
            /* width: auto auto; */
            margin-top: 30px;
            background-color: #FFFFFF;
            box-sizing: border-box;
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
            <h1 style="color: white;">Absensi</h1>
            <div class="komp">
                <div class="isi-komponen1">
                    <h4>CARI JADWAL LATIHAN</h4>
                </div>
                <div class="isi-komponen2">
                    <form action="" method="post">
                        <select class="form-select" aria-label="Default select example" id="id_jadwal" name="id_jadwal">
                            <option selected>PILIH JADWAL LATIHAN</option>
                            <?php
                            while ($baris1 = mysqli_fetch_assoc($tampil2)) {
                            ?>
                                <option value="<?php echo $baris1["id_jadwal"]; ?>"><?php echo $baris1["jadwal_latihan"]; ?></option>
                            <?php } ?>
                        </select>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Absensi</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Form Absensi</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <p style="display: none;">Nilai yang dipilih: <span id="selectedValue"></span></p>
                                            <div class="mb-3">
                                                <label for="tanggal_absensi" class="col-form-label">Tanggal Absen</label>
                                                <input type="date" class="form-control" id="tanggal_absensi" name="tanggal_absensi" readonly>
                                                <input type="date" class="form-control" id="tgl_absensi" name="tgl_absensi" hidden>
                                            </div>
                                            <div class="mb-3">
                                                <label for="resume_materi" class="col-form-label">Resume</label>
                                                <textarea class="form-control" id="resume_materi" name="resume_materi"></textarea>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="komp_table">
                <table class="table border table-bordered border-dark" style="text-align: center;">
                    <thead class="fw-bold">
                        <tr>
                            <td>NO</td>
                            <td>JADWAL LATIHAN</td>
                            <td>TANGGAL ABSENSI</td>
                            <td>RESUME</td>
                            <td>STATUS</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $a = 0;
                        while ($baris = mysqli_fetch_assoc($tampil)) {
                            $a += 1;
                        ?>
                            <tr>
                                <td><?php echo $a; ?></td>
                                <td><?php echo $baris["jadwal_latihan"]; ?></td>
                                <td><?php echo $baris["tanggal_absensi"]; ?></td>
                                <td><?php echo $baris["resume_materi"]; ?></td>
                                <td><?php echo $baris["status_absensi"]; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script>
            // Tangani perubahan nilai pada elemen <select>
            document.getElementById("id_jadwal").addEventListener("change", function() {
            // Dapatkan nilai yang dipilih
            var selectedValue = this.value;

            // Masukkan nilai ke dalam modal
            document.getElementById("selectedValue").textContent = selectedValue;

            // Atur nilai tanggal_absensi menjadi tanggal sekarang
            var currentDate = new Date().toISOString().split('T')[0];
            document.getElementById("tanggal_absensi").value = currentDate;
            document.getElementById("tgl_absensi").value = currentDate;

            // Nonaktifkan input tanggal_absensi
            document.getElementById("tanggal_absensi").disabled = true;
            });
            document.getElementById("submitAbsensi").addEventListener("click", function() {
                // Mengaktifkan kembali input tanggal_absensi saat tombol submit ditekan
                document.getElementById("tanggal_absensi").disabled = false;
            });
    </script>
</body>

</html>