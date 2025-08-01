<?php
$koneksi = mysqli_connect("localhost", "root", "", "jokotole");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST["judul"];
    $deskripsi = $_POST["deskripsi"];
    $kategori = $_POST["kategori"];
    $referensi = $_POST["referensi"];
    $foto_name = $_FILES["foto"]["name"];
    $foto_tmp_name = $_FILES["foto"]["tmp_name"];

    // Pindahkan file foto ke direktori tujuan
    move_uploaded_file($foto_tmp_name, "../../dist/img/beritaagenda/" . $foto_name);

    // Hubungkan ke database (menggunakan MySQLi)
    //$conn = new mysqli($servername, $username, $password, $database);

    // Periksa koneksi
    //if ($conn->connect_error) {
      //  die("Koneksi gagal: " . $conn->connect_error);
    //}
    // Dapatkan tanggal hari ini
    $tanggalnow= date('Y-m-d');
    // Persiapkan query untuk menyimpan data
    $sql = "INSERT INTO berita (tanggal_berita, judul_berita, deskripsi_berita, kategori_berita, referensi, foto_berita) 
            VALUES ('$tanggalnow', '$judul', '$deskripsi', '$kategori', '$referensi', '$foto_name')";
    if ($koneksi->query($sql) === TRUE) {
        session_start();
        $_SESSION['pesantambah'] = "Berita berhasil ditambahkan!";
        header("Location: beritaagenda_SuperAdmin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
    $koneksi->close();
} else {
    echo "Metode HTTP tidak valid!";
}
