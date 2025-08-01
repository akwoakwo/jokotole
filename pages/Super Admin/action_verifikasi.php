<?php
// Menghubungkan dengan database
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

// Cek apakah ada parameter 'id_edit' dalam URL
if (isset($_GET['id_edit'])) {
    $id_aktor = $_GET['id_edit'];

    // Melakukan query untuk mengubah status menjadi 'tetap'
    $query = "UPDATE aktor SET status = 'tetap' WHERE id_aktor = $id_aktor";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        header("location: verifikasi.php");
    }
}

// Cek apakah ada parameter 'id_hapus' dalam URL
if (isset($_GET['id_hapus'])) {
    $id = $_GET["id_hapus"];

    // Melakukan query untuk menghapus data sesuai id yang dipilih
    $hapus_data = "DELETE FROM aktor WHERE id_aktor='$id' ";
    $hasil = mysqli_query($koneksi, $hapus_data);

    if ($hasil) {
        header("location: verifikasi.php");
    }
}
