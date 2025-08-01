<?php
session_start();
$koneksi= mysqli_connect("localhost","root","","jokotole");
$id = $_GET['id'];
$sql = "DELETE FROM galeri_prestasi WHERE id_prestasi=$id";
$hasil = mysqli_query($koneksi,$sql);

if ($hasil){
   $_SESSION["sukses"] = 'Data Berhasil Dihapus';
   header("location:galeriprestasi.php");
}
?>