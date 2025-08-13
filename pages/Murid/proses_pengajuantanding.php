<?php
$koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');
session_start();

// Pastikan koneksi ke database sudah dibuat

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_murid = $_POST['id_murid'];
    $nama_lomba = $_POST['nama_lomba'];
    $berat_badan = $_POST['berat_badan'];
    $tinggi_badan = $_POST['tinggi_badan'];

    $query = mysqli_query($koneksi, "SELECT * FROM rekomendasi_lomba WHERE nama_perlombaan='$nama_lomba'");
    $lomba = mysqli_fetch_assoc($query);
    $id_lomba = $lomba['id_rekomendasi'];
    
    // Handling file uploads
    $surat_ijin = $_FILES['surat_ijin']['name'];
    $surat_sehat = $_FILES['surat_sehat']['name'];
    
    // Dapatkan nama file sementara
    $surat_ijin_tmp = $_FILES['surat_ijin']['tmp_name'];
    $surat_sehat_tmp = $_FILES['surat_sehat']['tmp_name'];

    // Direktori tujuan untuk menyimpan file
    $tujuan_dir = "../../dist/img/pengajuanlomba/";

    // Pindahkan file dari direktori sementara ke direktori tujuan
    if (move_uploaded_file($surat_ijin_tmp, $tujuan_dir . $surat_ijin) && move_uploaded_file($surat_sehat_tmp, $tujuan_dir . $surat_sehat)) {
        // Setelah mengambil nilai-nilai formulir dan menyimpan file, lakukan penyimpanan ke database
        $query = "INSERT INTO pengajuan_lomba (murid_id, rekomendasi_id, berat_badan, tinggi_badan, bukti_persetujuan_ortu, bukti_sehat, status_pengajuan) 
                  VALUES ('$id_murid', '$id_lomba', $berat_badan, $tinggi_badan, '$surat_ijin', '$surat_sehat', 'diproses')";

        if (mysqli_query($koneksi, $query)) {
            echo "Data berhasil disimpan ke database.";
            header("Location: daftarpengajuanlomba_tanding.php");
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
    } else {
        echo "Gagal mengunggah atau menyimpan file.";
    }
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
