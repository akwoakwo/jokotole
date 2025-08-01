<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

// Periksa apakah berita_id telah diterima melalui metode POST
if (isset($_POST['berita_id'])) {
    $berita_id = $_POST['berita_id'];

    // Jalankan query penghapusan berita berdasarkan berita_id
    $query = "DELETE FROM berita WHERE id_berita = $berita_id";

    if (mysqli_query($koneksi, $query)) {
        // Berhasil menghapus berita
        echo "Berita berhasil dihapus.";
    } else {
        // Gagal menghapus berita
        echo "Gagal menghapus berita: " . mysqli_error($koneksi);
    }
} else {
    // Jika berita_id tidak diterima, tampilkan pesan kesalahan
    echo "Berita ID tidak ditemukan.";
}

// Redirect kembali ke halaman berita setelah penghapusan
header("Location: beritaagenda_Admin.php");
exit;
