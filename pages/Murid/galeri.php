<?php
$koneksi=mysqli_connect("localhost","root","","jokotole");
$sql="SELECT id_prestasi, nama_prestasi, tingkat_prestasi, deskripsi_prestasi, foto_prestasi, nama 
FROM galeri_prestasi m, aktor p where m.murid_id=p.id_aktor";
$hasil=mysqli_query($koneksi,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Homepage SuperAdmin</title>

    <!-- My Own Styles -->
    <link rel="stylesheet" href="styl.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">



</head>

<body>
  <!-- Menu header -->
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
          <li><a href="#">Login</a></li>
          <li><a href="#" class="sign">Sign Up</a></li>
        </ul>
        </div>
      </nav>

 <div class="content">
    <div class="imgbox">
      <img src="../../dist/img/silat.png" class="silat">
    </div>
    <div class="textbox">
      <h1>PPS JOKOTOLE<br> DIKLAT KODIM 0829</h1>
      <a href="#">Daftar Sekarang</a>
    </div>
  </div>
  </header>

<main>
    <article id="galeri" class="card">
      <h2>Galeri Prestasi</h2>
        
      <?php
        while($baris=mysqli_fetch_assoc($hasil)){ 
      ?>
      <div class="rowbox">
        <img src="../../dist/img/<?php echo $baris['foto_prestasi'];?>" class="imgprestasi" >
        <h3><?php echo $baris['nama_prestasi'];?></h3>
        <p><?php echo $baris['tingkat_prestasi'];?></p>
        <p><?php echo $baris['nama'];?></p>
        <p>
        <?php echo $baris['deskripsi_prestasi'];?> 
        </p><br>
      </div>
      
      <?php }?>
      
      </article>
  </main>
  
<!-- javascript -->
    <script src="script.js"></script>

</body>
