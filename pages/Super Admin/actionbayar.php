<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

$id_pembayaran = $_GET['id'];
$currentDate = date('Y-m-d');

// Periksa apakah status_bayar sudah 'lunas' dan tanggal_bayar sudah terisi
$checkQuery = "SELECT status_bayar, tanggal_bayar FROM pembayaran_spp WHERE id_pembayaran = $id_pembayaran";
$result = mysqli_query($koneksi, $checkQuery);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $status_bayar = $row['status_bayar'];
    $tanggal_bayar = $row['tanggal_bayar'];

    if ($status_bayar == 'lunas' && !empty($tanggal_bayar)) {
        // Ubah status_bayar menjadi 'belum lunas' dan tanggal_bayar menjadi kosong
        $sql = "UPDATE pembayaran_spp SET status_bayar = 'belum lunas', tanggal_bayar = NULL WHERE id_pembayaran = $id_pembayaran";
        $hasil = mysqli_query($koneksi, $sql);

        if ($hasil) {
            header("location:spp.php");
        } else {
            header("location:none.php");
        }
    } else if ($status_bayar == 'belum lunas' && empty($tanggal_bayar)) {
        $sql = "UPDATE pembayaran_spp SET status_bayar = 'lunas', tanggal_bayar = '$currentDate'  WHERE id_pembayaran = $id_pembayaran";
        $hasil = mysqli_query($koneksi, $sql);

        if ($hasil) {
            header("location:spp.php");
        } else {
            header("location:none.php");
        }
    } else {
        echo "status_bayar bukan 'lunas' atau tanggal_bayar kosong.";
    }
} else {
    echo "Gagal mengambil data dari database.";
}

mysqli_close($koneksi);
