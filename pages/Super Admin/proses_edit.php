<?php
// Pastikan Anda telah menghubungkan ke database sebelumnya
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_berita = $_POST['id_berita'];
    $judul_berita = $_POST['judul'];
    $deskripsi_berita = $_POST['deskripsi'];
    $kategori_berita = $_POST['kategori'];
    $referensi = $_POST['referensi'];

    // Query untuk mengupdate informasi berita
    $query = "UPDATE berita SET 
                judul_berita='$judul_berita', 
                deskripsi_berita='$deskripsi_berita', 
                kategori_berita='$kategori_berita',
                referensi='$referensi'
              WHERE id_berita=$id_berita";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        session_start();
        $_SESSION['pesanedit'] = "Berita berhasil ditambahkan!";
        header("Location: beritaagenda_SuperAdmin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
} else {
    echo "Metode pengiriman data tidak valid.";
}
?>
