<?php
include "../config.php";

if (isset($_POST['tambah_materi'])) {
    // Proses tambah materi
    $nama_materi = $_POST['nama_materi'];
    $deskripsi_materi = $_POST['deskripsi_materi'];

    // Proses upload gambar dan simpan ke direktori yang sesuai
    if (isset($_FILES['foto_materi'])) {
        $file_name = $_FILES['foto_materi']['name'];
        $file_tmp = $_FILES['foto_materi']['tmp_name'];
        $file_type = $_FILES['foto_materi']['type'];
        $target_dir = "../../dist/img/materi/"; // Ganti dengan path direktori upload yang sesuai
        $target_file = $target_dir . $file_name;

        // Validasi dan periksa tipe file yang diizinkan
        $allowed_types = array("image/jpeg", "image/jpg", "image/png");
        if (in_array($file_type, $allowed_types)) {
            // Pindahkan file ke direktori upload
            move_uploaded_file($file_tmp, $target_file);

            // Simpan data ke database
            $insert_query = "INSERT INTO materi (nama_materi, deskripsi_materi, foto_materi) VALUES ('$nama_materi', '$deskripsi_materi', '$file_name')";
            $result = mysqli_query($koneksi, $insert_query);

            if ($result) {
                echo "data berhasil ditambah";
            
                // Data berhasil ditambahkan, tambahkan notifikasi berhasil
                header("Location: materi_pelatih.php"); // Redirect kembali ke halaman Materi Pembelajaran
            } else {
                // Data gagal ditambahkan, tambahkan notifikasi error
                echo "Error: " . mysqli_error($koneksi);
            }
        } else {
            // Tipe file tidak diizinkan, tambahkan notifikasi error
            echo "Tipe file tidak diizinkan.";
        }
    }
}
if (isset($_POST['edit_materi'])) {
    // Ambil data dari formulir
    $id_materi = $_POST['id_materi'];
    $nama_materi = $_POST['nama_materi'];
    $deskripsi_materi = $_POST['deskripsi_materi'];

    // Proses upload gambar jika ada perubahan
    $nama_gambar = null;
    if (!empty($_FILES['foto_materi']['name'])) {
        $file_name = $_FILES['foto_materi']['name'];
        $file_tmp = $_FILES['foto_materi']['tmp_name'];
        $file_type = $_FILES['foto_materi']['type'];
        $target_dir = "../../dist/img/materi/"; // Ganti dengan path direktori upload yang sesuai
        $target_file = $target_dir . $file_name;

        // Validasi dan periksa tipe file yang diizinkan
        $allowed_types = array("image/jpeg", "image/jpg", "image/png");
        if (in_array($file_type, $allowed_types)) {
            // Pindahkan file ke direktori upload
            move_uploaded_file($file_tmp, $target_file);
            $nama_gambar = $file_name;
        } else {
            // Tipe file tidak diizinkan, tambahkan notifikasi error
            echo "Tipe file tidak diizinkan.";
        }
    }

    // Perbarui data di database
    $update_query = "UPDATE materi SET nama_materi = '$nama_materi', deskripsi_materi = '$deskripsi_materi'";
    if ($nama_gambar !== null) {
        $update_query .= ", foto_materi = '$nama_gambar'";
    }
    $update_query .= " WHERE id_materi = $id_materi";
    $result = mysqli_query($koneksi, $update_query);

    if ($result) {
        echo "Data berhasil diperbarui.";
        header("Location: materi_pelatih.php"); // Redirect kembali ke halaman Materi Pembelajaran
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if (isset($_POST['hapus_materi'])) {
    // Proses hapus materi
    $id_materi = $_POST['id_materi'];

    // Ambil informasi file foto materi yang akan dihapus
    $select_query = "SELECT foto_materi FROM materi_pembelajaran WHERE id_materi = $id_materi";
    $result = mysqli_query($koneksi, $select_query);
    if ($row = mysqli_fetch_assoc($result)) {
        $file_to_delete = $row['foto_materi'];
        $file_path = "path/to/upload/directory/" . $file_to_delete; // Ganti dengan path direktori upload yang sesuai

        // Hapus file foto materi dari direktori
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        // Hapus data dari database
        $delete_query = "DELETE FROM materi_pembelajaran WHERE id_materi = $id_materi";
        $result = mysqli_query($koneksi, $delete_query);

        if ($result) {
            // Redirect kembali ke halaman Materi Pembelajaran
            header("Location: index.php");
        } else {
            // Tampilkan pesan error jika ada kesalahan
            echo "Error: " . mysqli_error($koneksi);
        }
    }
}

?>