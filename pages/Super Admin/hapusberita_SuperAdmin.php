<?php
// Pastikan Anda sudah memiliki koneksi ke database, atau tambahkan koneksi ke database di sini.
$koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');

// Periksa apakah parameter 'id' telah dikirim melalui metode GET
if (isset($_GET['id'])) {
    $id_berita = $_GET['id'];


    // Lakukan penghapusan berita dari database
    $query = "DELETE FROM berita WHERE id_berita = $id_berita";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Berita berhasil dihapus
        header("Location: beritaagenda_SuperAdmin.php?"); // Redirect kembali ke halaman berita
        exit();
    } else {
        // Terjadi kesalahan saat menghapus berita
        echo "Gagal menghapus berita. Silakan coba lagi.";
    }
} else {
    // Jika parameter 'id' tidak ditemukan
    echo "Parameter 'id' tidak valid.";
}
