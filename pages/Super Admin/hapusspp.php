<?php
$koneksi= mysqli_connect("localhost","root","","jokotole");
$id = $_GET['id'];
$sql = "DELETE FROM pembayaran_spp WHERE id_pembayaran=$id";
$hasil = mysqli_query($koneksi,$sql);

if ($hasil){
   header("location:spp.php");
}
?>