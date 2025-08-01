<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $deskripsi = $_POST["deskripsi"];
    $referensi = $_POST["referensi"];
    $tempat = $_POST["tempat"];
    $foto_name = $_FILES["foto"]["name"];
    $foto_tmp_name = $_FILES["foto"]["tmp_name"];
    $jurusan = $_POST["jurusan"];
    $tingkat = $_POST["tingkat"];


    // Pindahkan file foto ke direktori tujuan
    move_uploaded_file($foto_tmp_name, "../../dist/img/rekomendasilomba/" . $foto_name);

    // Hubungkan ke database (menggunakan MySQLi)
    //$conn = new mysqli($servername, $username, $password, $database);

    // Periksa koneksi
    //if ($conn->connect_error) {
    //  die("Koneksi gagal: " . $conn->connect_error);
    //}
    // Dapatkan tanggal hari ini
    $tanggalnow = date('Y-m-d');
    // Persiapkan query untuk menyimpan data
    $sql = "INSERT INTO rekomendasi_lomba (tanggal_lomba, nama_perlombaan,tingkat_perlombaan,jenis_perlombaan, deskripsi_lomba,referensi, tempat_lomba, pamflet,jurusan_id) 
            VALUES ('$tanggalnow', '$judul','$tingkat', '$jurusan', '$deskripsi', '$referensi', '$tempat','$foto_name','$jurusan')";
    if ($koneksi->query($sql) === TRUE) {
        session_start();
        $_SESSION['pesantambah'] = "Lomba berhasil ditambahkan!";
        header("Location: rekomendasilomba_SuperAdmin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
    $koneksi->close();
} else {
    echo "Metode HTTP tidak valid!";
}
