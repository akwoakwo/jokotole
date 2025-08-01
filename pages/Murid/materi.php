<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

$data_materi = "SELECT * FROM materi";
$hasil_materi = mysqli_query($koneksi, $data_materi);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelayakan</title>

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
    <!-- <link rel="stylesheet" href="../../dist/css/style.css"> -->

    <!-- My Own Styles -->
    <link rel="stylesheet" href="../../dist/css/styl.css">
    <link rel="stylesheet" href="../../dist/css/style2.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">


    <!-- Favicons -->
    <link href="../../dist/assets/img/favicon.png" rel="icon">
    <link href="../../dist/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../../dist/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../dist/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../dist/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../../dist/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../../dist/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../dist/assets/css/main.css" rel="stylesheet">

</head>

<body style="background-color: darkslategray;">
    <!-- Menu header -->

    <nav>
        <a href="#" class="logo"><img src="../../dist/img/logo.png"></a>
        <div class="navbar">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Merchandise</a></li>
                <li><a href="#galeri">Galeri Prestasi</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>

        <div class="log">
            <ul>
                <li><a href="#">Login</a></li>
                <li><a href="#" class="sign">Sign Up</a></li>
            </ul>
        </div>
    </nav>

    <br><br><br>
    <!-- Main content -->
    <section class="content" style="padding-top:50px">
        <div class="container">

            <div class="section-header">
                <h2 style="color: white;">Materi Dasar</h2>
            </div>
            <div  style="background-color: darkslategray;">
                <div class="container-fluid">
                    <div class="row">
                        <?php while ($data_materi = mysqli_fetch_assoc($hasil_materi)) { ?>
                        <div class="col-md-6">
                                <div class="card" style="width: 600px; background-color: #fff; ">
                            
                                <div class="card-body" style="background-color: #fff;">
                                    <div class="card" style="background-color: #fff;">
                                        <div class="row no-gutters d-flex justicy-content-center align-items-center"style="background-color: #fff;">
                                            <div class="col-md-5 d-flex justicy-content-center align-items-center" style="background-color: #fff;">
                                                <img src="../../dist/assets/img/materi/<?php echo $data_materi["foto_materi"]; ?>" class="card-img" alt="Gambar Materi">
                                            </div>
                                            <div class="col-md-7" style="background-color: #fff;">
                                                <div class="card-body" style="background-color: #fff;">
                                                    <h5 class="card-title" style="background-color: #fff;"><b><?php echo $data_materi["nama_materi"]; ?></b></h5>
                                                    <p class="card-text" style="background-color: #fff;"><?php echo $data_materi["deskripsi_materi"]; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </section>


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
                    <img src="../../dist/img/Jokotole.png" alt="">
                </div>

            </div>
        </div>

        <div class="container mt-4">
            <div class="copyright">
                &copy; Copyright <strong><span>JoktoleKodim0829</span></strong>.
            </div>
        </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="../../dist/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../dist/assets/vendor/aos/aos.js"></script>
    <script src="../../dist/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../../dist/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="../../dist/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="../../dist/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../../dist/assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../dist/assets/js/main.js"></script>

</body>

</html>
<!-- javascript -->
<script src="../../dist/js/script.js"></script>
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
    $('#confirmationModal').modal('hide');

    function refresh() {
        var newWindow = window.open('../Print_Inventaris.php', 'blank');
        window.location.reload();
    }
</script>

</body>