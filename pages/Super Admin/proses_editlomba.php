<?php
// Pastikan Anda telah menghubungkan ke database sebelumnya
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_rekomendasi = $_POST['id_rekomendasi'];
    $judul = $_POST["judul"];
    $deskripsi = $_POST["deskripsi"];
    $referensi = $_POST["referensi"];
    $tempat = $_POST["tempat"];
    $foto_name = $_FILES["foto"]["name"];
    $foto_tmp_name = $_FILES["foto"]["tmp_name"];
    $jurusan = $_POST["jurusan"];
    $tingkat = $_POST["tingkat"];
    $foto_name = $_FILES["foto"]["name"];
    $foto_tmp_name = $_FILES["foto"]["tmp_name"];

    move_uploaded_file($foto_tmp_name, "../../dist/img/rekomendasilomba/" . $foto_name);

    // Query untuk mengupdate informasi berita
    $query = "UPDATE rekomendasi_lomba SET 
                nama_perlombaan='$judul', 
                deskripsi_lomba='$deskripsi',
                referensi='$referensi',
                tingkat_perlombaan = '$tingkat',
                jenis_perlombaan = '$jurusan',
                tempat_lomba = '$tempat',
                pamflet = '$foto_name'
              WHERE id_rekomendasi=$id_rekomendasi";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        session_start();
        $_SESSION['pesanedit'] = "Lomba berhasil ditambahkan!";
        header("Location: rekomendasilomba_SuperAdmin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
} else {
    echo "Metode pengiriman data tidak valid.";
}
