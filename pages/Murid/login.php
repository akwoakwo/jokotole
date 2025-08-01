<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homepage Tanpa Login</title>

    <!-- My Own Styles -->
    <link rel="stylesheet" href="../../dist/css/styl.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- my font -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <style>
        .row {
            background-color: rgba(255, 255, 255, 0.3); /* Ubah nilai opacity untuk mengatur tingkat transparansi */
            border-radius: 15px; /* Ubah nilai sesuai kebutuhan Anda */
            padding: 50px;
            width: 480px;
            margin-right: 5px;
        }
        .container-fluid{
            margin-left: 310px;
            color: white;
        }
    </style>
</head>

<body>
  <!-- Menu header -->
  <header style="background-image: url(../../dist/img/gmb.png);">
      <nav>
        <a href="#" class="logo"><img src="../../dist/img/logo.png"></a>
        <div class="navbar">
          <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Merchandise</a></li>
          <li><a href="#galeri">Galeri Prestasi</a></li>
          <li><a href="materi_murid.php">Materi Dasar</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        </div>

        <div class="log">
        <ul>
          <li><a href="login.php">Login</a></li>
          <li><a href="#" class="sign"  data-bs-toggle="modal" data-bs-target="#registerModal">Sign Up</a></li>
        </ul>
        </div>
      </nav>

    <div class="content">
      <div class="imgbox">
        <img src="../../dist/img/silat.png" class="silat">
      </div>

    <div class="container-fluid">
    <h1>LOGIN</h1>
        <div class="row">
        
            <div class="col-md-6 "style="width:1500px;">
                <form action="proses_login.php" method="post">
                    <!-- Username -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" style="width: 350px; padding: 17px;" required>
                    </div><br>
                    <!-- Password -->
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" style="width: 350px; padding: 17px;" required>
                    </div> <br>
                    <!-- Login Button -->
                    <button type="submit" class="btn btn-success" style="width: 150px; padding: 17px; ">Login</button>
                </form>
            </div>
                        
        </div>
    </div>
    
</div>
   

</body>