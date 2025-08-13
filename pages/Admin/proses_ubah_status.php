<?php
$koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pengajuan = $_POST['id_pengajuan'];
    $status = $_POST['status'];

    // Update status di database
    $update_query = "UPDATE pengajuan_lomba SET status_pengajuan='$status' WHERE id_pengajuan='$id_pengajuan'";
    
    if (mysqli_query($koneksi, $update_query)) {
        // Jika berhasil, tampilkan pesan dengan JavaScript dan kembali ke halaman sebelumnya
        echo "<script>alert('Status berhasil diperbarui.'); window.history.go(-1);</script>";
        exit; // Menghentikan eksekusi script PHP agar tidak melanjutkan ke bagian bawah script
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error updating record: " . mysqli_error($koneksi);
    }
}

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
