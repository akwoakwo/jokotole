<?php
$koneksi= mysqli_connect("localhost","root","","jokotole");
$id = $_GET['id'];
$sql = "DELETE FROM aktor WHERE id_aktor=$id";
$hasil = mysqli_query($koneksi,$sql);

if ($hasil){
   header("location:strukturorganisasi.php");
}
?>