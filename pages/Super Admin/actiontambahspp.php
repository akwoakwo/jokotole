<?php
$koneksi= mysqli_connect("localhost","root","","jokotole");

$id_pembayaran = $_POST['id_pembayaran'];
$murid_id = $_POST['murid_id'];
$nominal_bayar = $_POST['nominal_bayar'];
$deadline_pembayaran = $_POST['deadline_pembayaran'];
$status_bayar = $_POST['status_bayar'];

$sql="INSERT INTO pembayaran_spp(id_pembayaran,murid_id,nominal_bayar,deadline_pembayaran,status_bayar) 
        VALUES ('$id_pembayaran','$murid_id','$nominal_bayar','$deadline_pembayaran','belum lunas')";
$hasil=mysqli_query($koneksi,$sql);


if ($hasil){
    header("location:spp.php");
 }

?>