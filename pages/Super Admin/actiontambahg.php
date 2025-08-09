<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");

// $id_prestasi = $_POST['id_prestasi'];
$nama_prestasi = $_POST['nama_prestasi'];
$tingkat_prestasi = $_POST['tingkat_prestasi'];
$deskripsi_prestasi = $_POST['deskripsi_prestasi'];
$murid_id = $_POST['murid_id'];
$foto_prestasi = $_FILES['foto_prestasi']['name'];

$hasil = false; // supaya tidak undefined

if ($foto_prestasi != "") {
    $ekstensiboleh = array('png', 'jpg');
    $x = explode('.', $foto_prestasi);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto_prestasi']['tmp_name'];

    if (in_array($ekstensi, $ekstensiboleh) === true) {
        if (move_uploaded_file($file_tmp, '../../dist/img/prestasi/' . $foto_prestasi)) {
            $sql = "INSERT INTO galeri_prestasi (nama_prestasi, tingkat_prestasi, deskripsi_prestasi, foto_prestasi, murid_id) 
                    VALUES ('$nama_prestasi', '$tingkat_prestasi', '$deskripsi_prestasi', '$foto_prestasi', '$murid_id')";
            $hasil = mysqli_query($koneksi, $sql);
        }
    } else {
        echo "<script>alert('Ekstensi file tidak diperbolehkan! Hanya PNG dan JPG.'); window.history.back();</script>";
        exit;
    }
} else {
    // Jika tidak ada foto, insert tanpa foto
    $sql = "INSERT INTO galeri_prestasi (nama_prestasi, tingkat_prestasi, deskripsi_prestasi, murid_id) 
            VALUES ('$nama_prestasi', '$tingkat_prestasi', '$deskripsi_prestasi', '$murid_id')";
    $hasil = mysqli_query($koneksi, $sql);
}

if ($hasil) {
    header("Location: galeriprestasi.php");
    exit;
} else {
    echo "<script>alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
    exit;
}
?>
