<?php
include 'pages/Koneksi.php';
session_start();

if (isset($_SESSION['nama']) && isset($_SESSION['id_aktor'])) {
  if (isset($_SESSION['role']) == 'Siswa') {
    header("Location: pages/Murid/pengaturan.php");
  }
  if (isset($_SESSION['role']) == 'Admin') {
    header("Location: pages/Admin/Dashboard_Admin.php");
  }
  if (isset($_SESSION['role']) == 'Super Admin') {
    header("Location: pages/Super Admin/Dashboard_SuperAdmin.php");
  }
  exit();
}

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password']; // Hash the input password using SHA-256

  $sql2 = "SELECT * FROM aktor WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $sql2);

  if ($result->num_rows > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['role'] == 'Siswa') {
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['id_aktor'] = $row['id_aktor'];
      $_SESSION['jurusan_id'] = $row['jurusan_id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['role'] = $row['role'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['tingkat'] = $row['tingkat'];
      header("Location: home.php");
      exit();
    }
    if ($row['role'] == 'Admin') {
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['id_aktor'] = $row['id_aktor'];
      $_SESSION['jurusan_id'] = $row['jurusan_id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['tingkat'] = $row['tingkat'];
      header("Location: pages/Admin/Dashboard_Admin.php");
      exit();
    }
    if ($row['role'] == 'Super Admin') {
      $_SESSION['nama'] = $row['nama'];
      $_SESSION['id_aktor'] = $row['id_aktor'];
      $_SESSION['jurusan_id'] = $row['jurusan_id'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['password'] = $row['password'];
      $_SESSION['tingkat'] = $row['tingkat'];
      header("Location: pages/Super Admin/Dashboard_SuperAdmin.php");
      exit();
    }
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" style="margin-top:7rem">
            <strong>Coba Lagi!</strong> Anda harus memeriksa kembali username dan password Anda.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
}
?>
<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM aktor a";
$hasil = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Homepage</title>

  <!-- CSS -->
  <link rel="stylesheet" href="dist/css/styl.css">
  <link rel="stylesheet" href="dist/css/style2.css">
  <link href="dist/assets/css/main.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- icons -->
  <link rel="icon" type="image/png" href="dist/img/Jokotole.png" />
  <!-- font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Vendor CSS Files -->
  <link href="dist/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="dist/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="dist/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
</head>

<body style="background-color: darkslategray;">
  <!-- Menu header -->
  <nav>
    <a href="#home" class="logo"><img src="dist/img/logo.png"></a>
    <div class="navbar" style="margin-left: 10%;">
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="#Merchandise">Merchandise</a></li>
        <li><a href="#galeri">Galeri Prestasi</a></li>
        <li><a href="#Contact">Contact</a></li>
      </ul>
    </div>

    <div class="log">
      <ul>
        <li><a href="" onclick="confirmAction()" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
        <li><a href="#" class="sign" data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</a></li>
      </ul>
    </div>
  </nav>

  <div class="content" id="home" style="background-image: url(dist/img/gmb.png);min-height: 100vh;">
    <div class="imgbox">
      <img src="dist/img/silat.png" class="silat">
    </div>
    <div class="textbox">
      <h1 class="fw-bold">PPS JOKOTOLE<br> DIKLAT KODIM 0829</h1>
      <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Daftar Sekarang</a>
    </div>
  </div>

  <!-- Register -->
  <div class="modal fade" id="registerModal" tabindex="-1" style="z-index: 10000;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background-color: #BED25E !important;">
          <h5 class="modal-title fw-bold">Form Pendaftaran Murid Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post" enctype="multipart/form-data" class="row">
          <div class="modal-body">
            <div class="row p-4">

              <!-- Nama -->
              <div class="m-1">
                <label for="" class="form-label">Nama Lengkap</label>
                <input class="form-control" type="text" name="nama" value="" required>
              </div>

              <!-- Email -->
              <div class="col-md-4 m-1">
                <label for="" class="form-label">Email</label>
                <input class="form-control" type="email" name="email" id="" required>
              </div>

              <!-- Telepon siswa -->
              <div class="col-md-4 m-1">
                <label for="" class="form-label">No. telepon</label>
                <input class="form-control" name="telepon" id="telepon" type="number" required>
                <span id="error_telepon_siswa" style="color: red;"></span>
              </div>

              <!-- Tanggal Lahir -->
              <div class="col-md-3 m-1">
                <label for="" class="form-label">Tanggal Lahir</label>
                <input class="form-control" type="date" name="tanggal_lahir" id="" multiple required>
              </div>

              <!-- Jenis kelamin -->
              <div class="col-md-4 m-1">
                <label for="" class="form-label">Jenis Kelamin</label>
                <div class="gender" style="display: flex;">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="laki laki" required>
                    <p for="laki_laki"> Laki-laki </p>
                  </div>
                  <div class="form-check" style="margin-left: 15px;">
                    <input class="form-check-input" type="radio" name="jenis_kelamin" value="perempuan" required>
                    <p for="perempuan"> Perempuan </p>
                  </div>
                </div>
              </div>

              <!-- Telepon wali -->
              <div class="col-md-4 m-1">
                <label for="" class="form-label">No. telepon Wali</label>
                <input class="form-control" name="telepon_wali" id="telepon_wali" type="number" required>
                <span id="error_telepon_wali" style="color: red;"></span>
              </div>

              <!-- Foto -->
              <div class="col-md-3 m-1">
                <label for="" class="form-label">Foto Formal (3x4)</label>
                <input class="form-control" name="foto" id="" type="file" accept="image/*" required>
              </div>

              <!-- Alamat -->
              <div class="m-1">
                <label for="" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="" type="text" required></textarea>
              </div>

              <!-- Username -->
              <div class="col-md-6">
                <label for="" class="form-label">Username</label>
                <input class="form-control" name="username" id="username" type="text" required>
                <span id="error_username" style="color: red;"></span>
              </div>

              <!-- Password -->
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input class="form-control" name="password" id="password" type="password" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="register" class="btn btn-warning">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal untuk menampilkan pesan alert -->
  <div class="modal fade" id="Danger" tabindex="-1" style="z-index: 10000;">
    <div class="modal-dialog modal-sm" style="max-width: fit-content;  margin-left: auto; margin-right: 15px; margin-top: 15px;">
      <div class="modal-header alert alert-danger fade show" style="height: 50px;">
        <i class="bi bi-exclamation-octagon me-1"></i>
        <p class="modal-title" id="alertDanger"></p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    </div>
  </div>
  <div class="modal fade" id="Success" tabindex="-1" style="z-index: 10000;">
    <div class="modal-dialog modal-sm" style="max-width: fit-content;  margin-left: auto; margin-right: 15px; margin-top: 15px;">
      <div class="modal-header alert alert-success fade show" style="height: 50px;">
        <i class="bi bi-check-circle me-1"></i>
        <p class="modal-title" id="alertSuccess"></p>
        <br>
        <a style="pointer-events: auto;" target="_blank" href="./pages/Murid/cetak_data.php">Download Data</a>
      </div>
    </div>
  </div>

  <!-- Login -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" style="z-index: 10000;">
    <div class="modal-dialog">
      <div class="modal-content">

        <form action="" method="POST" class="login-email">
          <div class="modal-header" style="background-color: #BED25E !important;">
            <h5 class="modal-title login-text fw-bold" id="loginModalLabel">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">

            <div class="d-flex align-items-center">
              <div class="me-3">
                <img src="dist/img/Jokotole.png" alt="Logo" style="height: 130px;"> 
              </div>

              <div class="flex-grow-1 w-100">
                <div class="input-group mb-3">
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                  <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                </div>

                <div class="input-group mb-3">
                  <span class="input-group-text"><i class="bi bi-lock"></i></span>
                  <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?php echo $_POST['password']; ?>" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                  </button>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer d-flex flex-column align-items-start">
            <button type="submit" name="submit" class="btn btn-warning w-100 mb-2">Login</button>
            <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p>
          </div>

        </form>

      </div>
    </div>
  </div>

  <main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about" style="color: white;">
      <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
          <div class="modal-content shadow">
            <div class="modal-header bg-light shadow-sm" style="background-color: #BED25E !important;">
              <h5 class="modal-title" id="exampleModalLabel">Login</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-md-5">
                    <div class="image">
                      <img src="dist/img/Jokotole.png" width="150" class="img-fluid" alt="">
                    </div>
                  </div>
                  <div class="col-md-7">
                    <form action="" method="POST" class="login-email">
                      <p class="login-text">Login</p>
                      <div class="input-group">
                        <label for="email" style="color: slategray;">Email : </label>
                        <input type="email" class="form-control form-control-sm" style="width: 20%;" id="email" name="email" placeholder="Enter email" required>
                      </div>
                      <br>
                      <div class="input-group">
                        <label for="password" style="color: slategray;">Password : </label>
                        <input type="password" class="form-control form-control-sm" style="width: 20%;" placeholder="Password" name="password" required>
                      </div><br>
                      <div class="input-group">
                        <button name="submit" class="btn btn-primary">Login</button>
                      </div>
                    </form>
                    <br>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer shadow-sm" style="background-color: #BED25E;">
            </div>
          </div>
        </div>
      </div> -->

      <div class="container" id="about" data-aos="fade-up">

        <div class="section-header">
          <h2>Profil Perguruan</h2>
        </div>

        <div class="row gy-4">
          <div class="col-lg-6">
            <img src="dist/img/Jokotole.png" style="width: 60%;" class="img-fluid rounded-4 mb-4" alt="">
          </div>
          <div class="col-lg-6">
            <h3 style="background-color: dimgrey; color:yellow; padding:2%; border-radius:20px; border:4px solid white;">Sejarah</h3>
            <p class="fst-italic" style="text-align: justify;">
              <?php
              $koneksi = mysqli_connect("localhost", "root", "", "jokotole");
              $sql = "SELECT * FROM profile_perguruan pm";
              $hasil = mysqli_query($koneksi, $sql);
              $baris = mysqli_fetch_assoc($hasil);
              echo $baris['sejarah']
              ?>
            </p>
            <h3 style="background-color: dimgrey; color:yellow; padding:2%; border-radius:20px; border:4px solid white;">Visi & Misi</h3>
            <p class="fst-italic" style="text-align: justify;">
              <?php
              echo $baris['visi_misi']
              ?>
            <h3 style="background-color: dimgrey; color:yellow; padding:2%; border-radius:20px; border:4px solid white;">Makna Lambang</h3>
            <p class="fst-italic" style="text-align: justify;">
              <?php
              echo $baris['arti_lambang']
              ?>
            </p>
          </div>
        </div>
      </div>
    </section><!-- End About Us Section -->

    <section>
      <div class="container" data-aos="fade-up">
        <div class="section-header" style="color: white;">
          <h2>Maps Perguruan</h2>
          <?php
          echo $baris['frame_map']
          ?>
        </div>
      </div>
      <style>
        p.konten1 {
          max-width: 180px;
          word-wrap: break-word;
          /* Memaksa teks untuk mematahkan secara otomatis */
        }

        .flex-contain {
          display: flex;
          flex-direction: row;
          align-items: flex-start;
        }

        .btpesan {
          position: static;
          border: 2px solid black;
          border-radius: 25px;
          margin-top: 1.7rem;
          margin-right: 0.2rem;
          width: 10rem;
          height: 2rem;
          font-size: medium;
          font-weight: 700;
          font-family: 'Poppins', sans-serif;
          align-self: flex-starct;
          cursor: pointer;

        }

        .btpesan:hover {
          background: #33b249;
          color: white;
        }

        .grid {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          margin: 80px;
          grid-gap: 30px;
        }

        article>img {
          object-fit: cover;
        }

        .grid>article {
          box-shadow: 10px 5px 5px 0px black;
          border-radius: 30px;
          text-align: left;
          background: #3D553D;
          width: 350px;
          height: 375px;
          transition: transform;
        }

        .grid>article img {
          border-top-left-radius: 30px;
          border-top-right-radius: 30px;
        }


        .grid>article:hover {
          transform: scale(1.2);
        }

        @media (max-width:1200px) {
          .grid {
            grid-template-columns: repeat(2, 1fr);
          }
        }

        @media (max-width:900px) {
          .grid {
            grid-template-columns: repeat(1, 1fr);
            align-items: center;
          }
        }
      </style>

      <?php
      require 'pages/Super Admin/koneksidbMerch.php';
      $merchandise = query("SELECT * FROM merchandise");
      ?>

      <div class="container py-5" data-aos="fade-up" id="Merchandise">
        <div class="section-header text-center text-white mb-4">
          <h2>MERCHANDISE</h2>
        </div>

        <div class="row justify-content-center">
          <?php foreach ($merchandise as $row) : ?>
            <div class="col-md-4 col-sm-6 mb-4 d-flex align-items-stretch">
              <div class="card bg-dark text-white shadow w-100" style="border-radius: 15px;">
                <img src="dist/img/<?php echo $row["foto_merchandise"]; ?>"
                  class="card-img-top"
                  alt="Merchandise Image"
                  style="width: 100%; padding:5px; height: 250px; object-fit: cover; aspect-ratio: 1 / 1; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <div class="card-body d-flex flex-column justify-content-between">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0" style="font-size: 1.5rem; font-weight: 600;"><?= $row["nama_merchandise"]; ?></h6>
                    <span class="text-warning" style="font-size: 1.5rem; font-weight: 600;">Rp <?= number_format($row["harga_merchandise"], 0, ',', '.'); ?></span>
                  </div>
                  <a href="pages/Murid/Beli_Merchandise.php" class="btn btn-warning fw-bold w-100 mt-auto">Pesan Sekarang</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <!-- ======= Call To Action Section ======= -->
    <section id="call-to-action" class="call-to-action">
      <div class="container text-center" data-aos="zoom-out">
        <a href="https://youtu.be/Fd3pnuK7nqU?si=t7n6ZE1QjYF3oJ2Q" class="glightbox play-btn"></a>
        <h3>Video Latihan</h3>
        <p> Perguruan Pencak Silat Jokotole Diklat Kodim 0829.</p>
        <a class="cta-btn" href="https://youtu.be/Fd3pnuK7nqU?si=t7n6ZE1QjYF3oJ2Q" target="_blank">Tonton</a>
      </div>
    </section><!-- End Call To Action Section -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.html" class="logo d-flex align-items-center">
              <span>Joktole Kodim 0829</span>
            </a>
            <p>xnjnjnj djndknfkd kmkmkd mkmkmkd</p>
            <div class="social-links d-flex mt-4">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="#">Home</a></li>
              <li><a href="#">About us</a></li>
              <li><a href="#">Merchandise</a></li>
              <li><a href="#">Galeri Prestasi</a></li>
              <li><a href="#">Contact</a></li>
            </ul>
          </div>


          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              Jl cikini digondang dia <br>
              Bangkalan, Jawa Timur<br>
              Indonesia <br><br>
              <strong>Phone:</strong> +6273728483943<br>
              <strong>Email:</strong> kodim0829@gmail.com<br>
            </p>

          </div>
          <div class="col-lg-2 col-6 footer-links">
            <img src="dist/img/Jokotole.png" alt="">
          </div>

        </div>
      </div>

      <div class="container mt-4">
        <div class="copyright">
          &copy; Copyright <strong><span>JoktoleKodim0829</span></strong>.
        </div>
      </div>

    </footer>
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- JS -->
    <script src="dist/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Vendor JS Files -->
    <script src="dist/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- Template Main JS File -->
    <script src="dist/assets/js/main.js"></script>

    <script>
      $(document).ready(function() {
        $("#myBtn").click(function() {
          $("#myModal").modal();
        });
      });
    </script>

    <!-- Registrasi Area -->
    <script>
      <?php

      if (isset($_POST["register"])) {
        $nama = $_POST["nama"];
        $tanggal_lahir = $_POST["tanggal_lahir"];
        $email = $_POST["email"];
        $telepon = $_POST["telepon"];
        $jenis_kelamin = isset($_POST["jenis_kelamin"]) ? $_POST["jenis_kelamin"] : "";
        $alamat = $_POST["alamat"];
        $telepon_wali = $_POST["telepon_wali"];
        $username = $_POST["username"];
        // $password = md5($_POST["password"]);
        $password = $_POST["password"];

        // Menangani unggah gambar
        $nama_file = str_replace(' ', '_', $nama); // Ganti spasi dengan garis bawah
        $foto = $_FILES["foto"]["name"];
        $temp_file = $_FILES["foto"]["tmp_name"];
        $ext = pathinfo($foto, PATHINFO_EXTENSION);  // Ekstensi gambar
        $upload_dir = "./dist/assets/img/profile/";
        $db_foto =  $nama_file . '.' . $ext;
        $target_file = $upload_dir . $nama_file . '.' . $ext; // Nama file foto disesuaikan dengan inputan nama

        // Melakukan pengecekan
        $cek_username = "SELECT * FROM aktor WHERE username = '$username'";
        $cek_nama = "SELECT * FROM aktor WHERE nama = '$nama'";
        $cek_email = "SELECT * FROM aktor WHERE email = '$email'";

        if (mysqli_num_rows(mysqli_query($koneksi, $cek_nama)) > 0) {
          $message_danger = "Nama Tersedia, Gagal Menambahkan Data!";
          echo "showDanger('$message_danger')";
        } elseif (mysqli_num_rows(mysqli_query($koneksi, $cek_nama)) > 0) {
          $message_danger = "Email Tersedia, Gagal Menambahkan Data!";
          echo "showDanger('$message_danger')";
        } elseif (mysqli_num_rows(mysqli_query($koneksi, $cek_username)) > 0) {
          $message_danger = "Username Tersedia, Gagal Menambahkan Data!";
          echo "showDanger('$message_danger')";
        } else {
          if (move_uploaded_file($temp_file, $target_file)) {

            $query_max_id = "SELECT MAX(id_aktor) as max_id FROM aktor";
            $result_max_id = mysqli_query($koneksi, $query_max_id);
            $row_max_id = mysqli_fetch_assoc($result_max_id);
            $max_id = $row_max_id['max_id'];

            if ($max_id === null) {
              $max_id = 1;
            } else {
              $max_id++;
              $tambah_data = "INSERT INTO aktor (id_aktor, jurusan_id, nama, tanggal_lahir, email, telepon, gender, alamat, foto, telepon_wali, tingkatan, username, password, role, status) VALUES ($max_id, 1, '$nama', '$tanggal_lahir', '$email', '$telepon', '$jenis_kelamin', '$alamat', '$db_foto', '$telepon_wali', 'putih', '$username', '$password', 'Siswa', 'calon')";
              $hasil = mysqli_query($koneksi, $tambah_data);
            }

            if ($hasil) {
              $message_success = "Data Anda Berhasil Disimpan !";
              echo "showSuccess('$message_success')";
            } else {
              $message_success = "Gagal Menambahkan Data !";
              echo "showDanger('$message_success')";
            }
          }
        }
      }
      ?>

      function showDanger(message) {
        document.getElementById('alertDanger').innerText = message;
        var modalDanger = new bootstrap.Modal(document.getElementById('Danger'));
        modalDanger.show();
      }

      function showSuccess(messageee) {
        document.getElementById('alertSuccess').innerText = messageee;
        var modalSuccess = new bootstrap.Modal(document.getElementById('Success'));
        modalSuccess.show();
      }
    </script>

    <script>
      function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");
        if (passwordInput.type === "password") {
          passwordInput.type = "text";
          eyeIcon.classList.remove("bi-eye");
          eyeIcon.classList.add("bi-eye-slash");
        } else {
          passwordInput.type = "password";
          eyeIcon.classList.remove("bi-eye-slash");
          eyeIcon.classList.add("bi-eye");
        }
      }
    </script>

</body>

</html>