<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../../dist/img/Jokotole.png" />
    <link rel="stylesheet" href="styl.css" />
    <title>Struktur Organisasi</title>
</head>
<body>
<header>
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
          <li><a href="search/galeriprestasi.php">Login</a></li>
          <li><a href="#" class="sign">Sign Up</a></li>
        </ul>
        </div>
      </nav>
  </header>
  <div class= "text-center mt-3" style="color: white;">
    <h1><b>STRUKTUR ORGANISASI</b></h1>
    <div class= "ml-5 mr-5 ">
    <p>Struktur organisasi dalam dunia Pancak Silat mencerminkan hierarki dan sistem yang terorganisir untuk pengembangan, pembelajaran, 
      dan penyebaran seni bela diri ini. Pada tingkat paling atas, terdapat pemimpin atau guru utama yang memiliki pengetahuan mendalam 
      dan keahlian tinggi dalam Pancak Silat. Di bawahnya, terdapat sekretaris, bendahara dan instruktur-instruktur senior yang bertanggung 
      jawab atas pelatihan dan bimbingan pesilat di tingkat yang lebih rendah.</p>
      </div>
  </div>
<?php
$koneksi=mysqli_connect("localhost","root","","jokotole");
$sql="SELECT * from aktor where status='KEPALA DIKLAT'";
$hasil=mysqli_query($koneksi,$sql);
$baris = mysqli_fetch_assoc($hasil);
?>
<div class="kartu row-cols-1 row-cols-md-5 ">
  <div class="col">
    <div class="card">
    <h4 class="status card-title mt-3 mb-3"><b><?php echo $baris['status'] ?></b></h4>
      <img src="../../dist/img/<?php echo $baris['foto'];?>" class="card-img-top" alt="..." width="20px">
      <div class="card-body">
        <h5 class="card-title"><?php echo $baris['nama'] ?></h5>
        <p class="card-text">
        Tanggal Lahir : <?php echo $baris['tanggal_lahir'] ?><br>
        Gender : <?php echo $baris['gender'] ?><br>
        Alamat : <?php echo $baris['alamat'] ?></p>
      </div>
    </div>
  </div>
</div>

<?php
$koneksi=mysqli_connect("localhost","root","","jokotole");
$sql="SELECT * from aktor where status='SEKRETARIS'";
$hasila=mysqli_query($koneksi,$sql);
$barisa = mysqli_fetch_assoc($hasila);
?>
<div class="kartu row-cols-1 row-cols-md-5 ">
  <div class="col ml-5 mr-5">
    <div class="card ">
    <h4 class="status card-title mt-3 mb-3"><b><?php echo $barisa['status'] ?></b></h4>
      <img src="../../dist/img/<?php echo $barisa['foto'];?>" class="card-img-top" alt="..." width="20px">
      <div class="card-body">
      <h5 class="card-title"><?php echo $barisa['nama'] ?></h5>
        <p class="card-text">
        Tanggal Lahir : <?php echo $barisa['tanggal_lahir'] ?><br>
        Gender : <?php echo $barisa['gender'] ?><br>
        Alamat : <?php echo $barisa['alamat'] ?></p>
      </div>
    </div>
  </div>

  <?php
  $koneksi=mysqli_connect("localhost","root","","jokotole");
  $sql="SELECT * from aktor where status='BENDAHARA'";
  $hasilb=mysqli_query($koneksi,$sql);
  $barisb = mysqli_fetch_assoc($hasilb);
  ?>
  <div class="col ml-5 mr-5">
    <div class="card">
    <h4 class="status card-title mt-3 mb-3"><b><?php echo $barisb['status'] ?></b></h4>
      <img src="../../dist/img/<?php echo $barisb['foto'];?>" class="card-img-top" alt="..." width="20px">
      <div class="card-body">
      <h5 class="card-title"><?php echo $barisb['nama'] ?></h5>
        <p class="card-text">
        Tanggal Lahir : <?php echo $barisb['tanggal_lahir'] ?><br>
        Gender : <?php echo $barisb['gender'] ?><br>
        Alamat : <?php echo $barisb['alamat'] ?></p>
      </div>
    </div>
  </div>
</div>


<?php
  $koneksi=mysqli_connect("localhost","root","","jokotole");
  $sql="SELECT * from aktor where status='PELATIH 1'";
  $hasil1=mysqli_query($koneksi,$sql);
  $baris1 = mysqli_fetch_assoc($hasil1);
  ?>
<div class="kartu row-cols-1 row-cols-md-5 mb-5">
  <div class="col">
    <div class="card">
    <h4 class="status card-title mt-3 mb-3"><b><?php echo $baris1['status'] ?></b></h4>
    <img src="../../dist/img/<?php echo $baris1['foto'];?>" class="card-img-top" alt="..." width="20px">
      <div class="card-body">
      <h5 class="card-title"><?php echo $baris1['nama'] ?></h5>
        <p class="card-text">
        Tanggal Lahir : <?php echo $baris1['tanggal_lahir'] ?><br>
        Gender : <?php echo $baris1['gender'] ?><br>
        Alamat : <?php echo $baris1['alamat'] ?></p>
      </div>
    </div>
  </div>
    
  <?php
  $koneksi=mysqli_connect("localhost","root","","jokotole");
  $sql="SELECT * from aktor where status='PELATIH 2'";
  $hasil2=mysqli_query($koneksi,$sql);
  $baris2 = mysqli_fetch_assoc($hasil2);
  ?>
  <div class="col">
    <div class="card">
    <h4 class="status card-title mt-3 mb-3"><b><?php echo $baris2['status'] ?></b></h4>
    <img src="../../dist/img/<?php echo $baris2['foto'];?>" class="card-img-top" alt="..." width="20px">
      <div class="card-body">
      <h5 class="card-title"><?php echo $baris2['nama'] ?></h5>
        <p class="card-text">
        Tanggal Lahir : <?php echo $baris2['tanggal_lahir'] ?><br>
        Gender : <?php echo $baris2['gender'] ?><br>
        Alamat : <?php echo $baris2['alamat'] ?></p>
      </div>
    </div>
  </div>

  <?php
  $koneksi=mysqli_connect("localhost","root","","jokotole");
  $sql="SELECT * from aktor where status='PELATIH 3'";
  $hasil3=mysqli_query($koneksi,$sql);
  $baris3 = mysqli_fetch_assoc($hasil3);
  ?>
  <div class="col">
    <div class="card">
    <h4 class="status card-title mt-3 mb-3"><b><?php echo $baris3['status'] ?></b></h4>
    <img src="../../dist/img/<?php echo $baris3['foto'];?>" class="card-img-top" alt="..." width="20px">
      <div class="card-body">
      <h5 class="card-title"><?php echo $baris3['nama'] ?></h5>
        <p class="card-text">
        Tanggal Lahir : <?php echo $baris3['tanggal_lahir'] ?><br>
        Gender : <?php echo $baris3['gender'] ?><br>
        Alamat : <?php echo $baris3['alamat'] ?></p>
      </div>
    </div>
  </div>

  <?php
  $koneksi=mysqli_connect("localhost","root","","jokotole");
  $sql="SELECT * from aktor where status='PELATIH 4'";
  $hasil4=mysqli_query($koneksi,$sql);
  $baris4 = mysqli_fetch_assoc($hasil4);
  ?>
  <div class="col">
    <div class="card">
    <h4 class="status card-title mt-3 mb-3"><b><?php echo $baris4['status'] ?></b></h4>
    <img src="../../dist/img/<?php echo $baris4['foto'];?>" class="card-img-top" alt="..." width="20px">
      <div class="card-body">
      <h5 class="card-title"><?php echo $baris4['nama'] ?></h5>
        <p class="card-text">
        Tanggal Lahir : <?php echo $baris4['tanggal_lahir'] ?><br>
        Gender : <?php echo $baris4['gender'] ?><br>
        Alamat : <?php echo $baris4['alamat'] ?></p>
      </div>
    </div>
  </div>
</div>

<script src="script.js"></script>

<!--<div class="row row-cols-1 row-cols-md-5 g-4">
  <div class="col">
    <div class="card">
      <img src="p.jpg" class="card-img-top" alt="..." width="20px">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  
  <div class="col">
    <div class="card">
      <img src="p.jpg" class="card-img-top" alt="..." width="20px">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="card">
      <img src="p.jpg" class="card-img-top" alt="..." width="20px">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div>


<div class="container row-cols-md-5 ">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card mx-auto">
                <img src="p.jpg" class="card-img-top" alt="..." width="20px">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card mx-auto">
                <img src="p.jpg" class="card-img-top" alt="..." width="20px">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <!--<div class="container mt-4">
        <div class="org-chart">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">CEO</h5>
                </div>
            </div>
            <div class="d-flex">
                <div class="card mr-2">
                    <div class="card-body">
                        <h5 class="card-title">Pelatih 1</h5>
                    </div>
                </div>
                <div class="card mr-2">
                    <div class="card-body">
                        <h5 class="card-title">Pelatih 2</h5>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pelatih 3</h5>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <div class="card mr-2">
                    <div class="card-body">
                        <h5 class="card-title">Siswa 1</h5>
                    </div>
                </div>
                <div class="card mr-2">
                    <div class="card-body">
                        <h5 class="card-title">Siswa 2</h5>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Siswa 3</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
