<?php
$koneksi = mysqli_connect("localhost","root","","jokotole");

$id_pembayaran = $_POST['id_pembayaran'];
$tanggal_bayar = $_POST['tanggal_bayar'];
$nominal_bayar = $_POST['nominal_bayar'];
$deadline_pembayaran = $_POST['deadline_pembayaran'];

$sql ="UPDATE pembayaran_spp SET
       tanggal_bayar = '$tanggal_bayar',
       nominal_bayar ='$nominal_bayar',
       deadline_pembayaran = '$deadline_pembayaran'
        WHERE id_pembayaran = $id_pembayaran";

$hasil = mysqli_query($koneksi, $sql);

if ($hasil){
    header("location:spp.php");
 }
?>
