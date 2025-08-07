<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

// Pastikan pengguna sudah login dan role adalah Siswa
if (!isset($_SESSION['nama']) || !isset($_SESSION['id_aktor']) || $_SESSION['role'] != 'Siswa') {
    header("Location: ../../index.php");
    exit();
}

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siswa | Pengajuan Lomba Tanding</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />
    <link href="../../dist/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

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
                            <h1 style="color: #fff;margin-top:70px;"><b>Form Pengajuan Lomba</b></h1>
                        </div>
                    </div>
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="box-body">
                                        <form action="proses_pengajuantanding.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" id="id_murid" name="id_murid" value="<?php echo $baris['id_aktor'] ?>">

                                            <div class="mb-3">
                                                <label for="nama_lomba" class="form-label">Nama Lomba</label>
                                                <select id="nama_lomba" name="nama_lomba" class="form-select" required>
                                                    <?php
                                                    $query2 = mysqli_query($koneksi, "SELECT * FROM rekomendasi_lomba WHERE jenis_perlombaan='2' OR jenis_perlombaan='seni'");
                                                    while ($row = mysqli_fetch_assoc($query2)) {
                                                        echo "<option value='" . $row['nama_perlombaan'] . "'>" . $row['nama_perlombaan'] . "</option>";
                                                    }
                                                    mysqli_close($koneksi);
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="berat_badan" class="form-label">Berat Badan (kg)</label>
                                                <input type="number" id="berat_badan" name="berat_badan" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="tinggi_badan" class="form-label">Tinggi Badan (cm)</label>
                                                <input type="number" id="tinggi_badan" name="tinggi_badan" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="surat_ijin" class="form-label">Surat Izin Orang Tua (PDF)</label>
                                                <input type="file" id="surat_ijin" name="surat_ijin" accept=".pdf" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="surat_sehat" class="form-label">Surat Sehat (PDF)</label>
                                                <input type="file" id="surat_sehat" name="surat_sehat" accept=".pdf" class="form-control" required>
                                            </div>

                                            <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
                                        </form>
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

    <!-- <script>
        const passwordInput = document.getElementById("password");
        const showPasswordCheckbox = document.getElementById("showPassword");

        showPasswordCheckbox.addEventListener("change", function() {
            if (showPasswordCheckbox.checked) {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        });

        const inputFields = document.querySelectorAll('.form-control');
        const profileImage = document.getElementById('profileImage');
        const submitButton = document.getElementById('submitButton');

        // Simpan nilai awal input dalam array
        const previousValues = Array.from(inputFields, inputField => inputField.value);
        const originalImageSrc = profileImage.src;

        // Tambahkan event listener untuk mendengarkan perubahan pada inputan
        inputFields.forEach((inputField, index) => {
            inputField.addEventListener('input', checkSubmitButtonStatus);
        });

        // Tambahkan event listener untuk mendengarkan perubahan pada gambar
        profileImage.addEventListener('change', checkSubmitButtonStatus);

        function checkSubmitButtonStatus() {
            let inputChanged = false;
            let imageChanged = false;

            inputFields.forEach((inputField, index) => {
                if (inputField.value.trim() !== '' && inputField.value !== previousValues[index]) {
                    inputChanged = true;
                }
            });

            if (profileImage.src !== originalImageSrc) {
                imageChanged = true;
            }

            if (inputChanged || imageChanged) {
                // Aktifkan tombol jika ada perubahan pada input atau gambar
                submitButton.removeAttribute('disabled');
            } else {
                // Nonaktifkan tombol jika tidak ada perubahan
                submitButton.setAttribute('disabled', 'true');
            }
        }
        // Tambahkan event listener untuk menghandle klik pada tombol
        submitButton.addEventListener('click', function() {
            alert('Tombol diklik!');
        });
    </script> -->
</body>

</html>