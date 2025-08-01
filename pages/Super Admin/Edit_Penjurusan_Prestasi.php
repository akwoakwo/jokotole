<?php
session_start();
if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
    header("Location: index.php");
}
$id = $_GET['id'];
$id_jur = $_GET['id_jur'];

$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
$sql = "SELECT * FROM aktor a WHERE id_aktor = $id";
$hasil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($hasil);

require_once("../Koneksi.php");

$query = "UPDATE aktor SET jurusan_id = $id_jur WHERE id_aktor = $id";
$queryact = mysqli_query($conn, $query);
echo ("<script>location.href = 'Penjurusan_Prestasi.php';</script>");
