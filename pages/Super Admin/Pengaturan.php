<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
}
$aktorr = $_SESSION['id_aktor'];
$conn = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM aktor a WHERE id_aktor = $aktorr";
$hasill = mysqli_query($conn, $sql);
$bariss = mysqli_fetch_assoc($hasill);
$id_super_admin = $_SESSION['id_aktor'];

//melakukan query menampilkan data
$data_murid = "SELECT aktor.*, jurusan.nama_jurusan FROM aktor LEFT JOIN jurusan ON aktor.jurusan_id = jurusan.id_jurusan WHERE aktor.id_aktor = $id_super_admin";
$hasil = mysqli_query($koneksi, $data_murid);
$row = mysqli_fetch_assoc($hasil);

if (isset($_POST['kirim'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nama = $_POST["nama"];
    $tanggal_lahir = $_POST["tanggal_lahir"];
    $email = $_POST["email"];
    $telepon = $_POST["telepon"];
    $gender = $_POST["gender"];
    $alamat = $_POST["alamat"];
    $tingkatan = $_POST["tingkatan"];

    $edit_data = "UPDATE aktor set nama = '$nama', tanggal_lahir = '$tanggal_lahir', email = '$email', telepon = '$telepon', gender = '$gender', alamat = '$alamat', tingkatan = '$tingkatan', username = '$username', password = '$password' where id_aktor = $id_super_admin ";
    $update_data = mysqli_query($koneksi, $edit_data);

    if ($update_data) {
        $_SESSION['success'] = "Profile berhasil diupdate !";
        header("Location: pengaturan_super_admin.php");
        exit();
    } else {
        $_SESSION['error'] = "Gagal mengupdate !";
        header("Location: pengaturan_super_admin.php");
        exit();
    }
}

if (isset($_POST['submit'])) {
    // Memeriksa apakah ada unggahan gambar
    if ($_FILES["foto"]["error"] == UPLOAD_ERR_OK) {
        $nama = $_POST["nama"];
        $nama_file = str_replace(' ', '_', $nama);
        $foto = $_FILES["foto"]["name"];
        $temp_file = $_FILES["foto"]["tmp_name"];
        $ext = pathinfo($foto, PATHINFO_EXTENSION);  // Ekstensi gambar
        $upload_dir = "../../dist/assets/img/profile/";
        $db_foto =  $nama_file . '.' . $ext;
        $target_file = $upload_dir . $nama_file . '.' . $ext; // Nama file foto disesuaikan dengan inputan nama

        // Pindahkan gambar yang diunggah ke direktori yang diinginkan
        if (move_uploaded_file($temp_file, $target_file)) {
            // Gambar berhasil diunggah, sekarang Anda dapat menyimpan nama file gambar ini ke database
            $edit_foto = "UPDATE aktor SET foto = '$db_foto' WHERE id_aktor = $id_aktor";
            $update_foto = mysqli_query($koneksi, $edit_foto);

            if ($update_foto) {
                $_SESSION['success'] = "Foto rofile berhasil diupdate !";
                header("Location: pengaturan_super_admin.php");
                exit();
            } else {
                $_SESSION['error'] = "Gagal mengupdate foto profile";
                header("Location: pengaturan_super_admin.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Gagal mengunggah foto profile";
            header("Location: pengaturan_super_admin.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Gagal mengunggah foto profile";
        header("Location: pengaturan_super_admin.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin | Pengaturan</title>

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
    <link rel="icon" type="image" href="../../dist/img/Jokotole.png" />

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="dist/assets/css/main.css" rel="stylesheet">
    <style>
        img {
            /* border: 2px solid;  */
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
            width: 50%;
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
            include 'sidebar/sidebar.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: #18191A;">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: #fff;margin-top:70px;"><b>Pengaturan</b></h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card-body" style="padding-bottom: 75px;">
                        <!-- Modal untuk menampilkan pesan alert -->
                        <?php
                        if (isset($_SESSION['success'])) {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <i class='bi bi-check-circle me-1'></i>
                                        {$_SESSION['success']}
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                            unset($_SESSION['success']);
                        }

                        if (isset($_SESSION['error'])) {
                            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <i class='bi bi-exclamation-circle me-1'></i>
                                        {$_SESSION['error']}
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                            unset($_SESSION['error']);
                        }
                        ?>
                        <!-- End modal -->
                        <div class="col-lg-12 mb-4 px-lg-2" style="margin-right:auto; margin-left: auto">
                            <div class="card mb-4 border-2 shadow">
                                <div class="row g-0 p-3 align-items-center">
                                    <div class="conten">
                                        <img id="profileImage" src="../../dist/img/profile/<?php echo $row["foto"]; ?>" alt="Gambar Materi" class="image" width="100">
                                        <div class="middle">
                                            <div class="text">
                                                <button type="button" class="btn btn-outline-dark w-10 shadow-none" data-bs-toggle="modal" data-bs-target="#image-profil">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-0 p-3 align-items-center">
                                    <div class="">
                                        <form action="" id="rooms-setting" method="post">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="username"> Username </label>
                                                        <input type="text" id="username" name="username" class="form-control shadow-none" value="<?php echo $row['username']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="passowrd"> Pasword </label>
                                                        <input type="password" id="password" name="password" class="form-control shadow-none" value="<?php echo $row['password']; ?>" required>
                                                        <input type="checkbox" id="showPassword"> Tampilkan Password
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="nama"> Nama </label>
                                                        <input type="text" id="nama" name="nama" class="form-control shadow-none" value="<?php echo $row['nama']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="tanggal_lahir"> Tanggal lahir </label>
                                                        <input type="text" id="tanggal_lahir" name="tanggal_lahir" class="form-control shadow-none" value="<?php echo $row['tanggal_lahir']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="email"> E-mail </label>
                                                        <input type="text" id="email" name="email" class="form-control shadow-none" value="<?php echo $row['email']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold"> Telepon </label>
                                                        <input type="text" id="telepon" name="telepon" class="form-control shadow-none" value="<?php echo $row['telepon']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="gender"> Gender </label>
                                                        <!-- <input type="text" id="gender" name="gender" class="form-control shadow-none" value="" required> -->
                                                        <select name="gender" id="gender" class="form-control shadow-none">
                                                            <option selected hidden><?php echo $row['gender']; ?></option>
                                                            <option value="Laki-laki">Laki-laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold"> Alamat </label>
                                                        <input type="text" id="alamat" name="alamat" class="form-control shadow-none" value="<?php echo $row['alamat']; ?>" required>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label fw-bold" for="tingkatan"> Tingkatan </label>
                                                        <input type="text" id="tingkatan" name="tingkatan" class="form-control shadow-none" value="<?php echo $row['tingkatan']; ?>" disabled>
                                                    </div>
                                                    <!-- <div class="col-md-12 mb-3">
                                                            <input type="hidden" id="telepon_wali" name="telepon_wali" class="form-control shadow-none" value="<?php echo $row['telepon_wali']; ?>" required>
                                                        </div> -->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button id="submitButton" name="kirim" class="btn btn-outline-dark w-175 shadow-none" disabled>Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="image-profil" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Update Image</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <input type="hidden" id="nama" name="nama" class="form-control shadow-none" value="<?php echo $row['nama']; ?>" required>
                                            <input type="file" name="foto" class="form-control shadow-none" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-success text-white shadow-none" name="submit">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer" style="background-color: #292C30; position: fixed;bottom: 0;width: 100%;">
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
    <script src="../../dist/js/demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
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
    </script>
</body>

</html>