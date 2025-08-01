<?php
// Pastikan Anda sudah memiliki koneksi ke database, atau tambahkan koneksi ke database di sini.
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

// Periksa apakah parameter 'id' telah dikirim melalui metode GET
if (isset($_GET['id'])) {
    $id_rekomendasi = $_GET['id'];


    // Lakukan penghapusan berita dari database
    $query = "DELETE FROM rekomendasi_lomba WHERE id_rekomendasi = $id_rekomendasi";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Berita berhasil dihapus
        header("Location: rekomendasilomba_SuperAdmin.php?"); // Redirect kembali ke halaman berita
        exit();
    } else {
        // Terjadi kesalahan saat menghapus berita
        echo "Gagal menghapus Lomba. Silakan coba lagi.";
    }
} else {
    // Jika parameter 'id' tidak ditemukan
    echo "Parameter 'id' tidak valid.";
}
