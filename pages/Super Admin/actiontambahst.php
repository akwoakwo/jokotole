<?php
$koneksi = mysqli_connect('localhost', 'urbeing1_jokotole_user', 'jokotoleuser0', 'urbeing1_jokotole');

$id_aktor = $_POST['id_aktor'];
$jurusan_id = $_POST['jurusan_id'];
$nama = $_POST['nama'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$email = $_POST['email'];
$telepon = $_POST['telepon'];
$gender = $_POST['gender'];
$alamat = $_POST['alamat'];
$telepon_wali = $_POST['telepon_wali'];
$tingkatan = $_POST['tingkatan'];
$username = $_POST['username'];
$password = $_POST['password'];
$status = $_POST['status'];
$role = $_POST['role'];
$foto = $_FILES['foto']['name'];

if ($foto != "") {
    $ekstensiboleh = array('png', 'jpg');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];

    if (in_array($ekstensi, $ekstensiboleh) === true) {
        move_uploaded_file($file_tmp, '../../dist/img/' . $foto);

        $sql = "INSERT INTO aktor(id_aktor, jurusan_id, nama, tanggal_lahir, email, telepon, gender, alamat, telepon_wali, tingkatan,
        username, password, status, foto, role) 
        VALUES ('$id_aktor','$jurusan_id','$nama','$tanggal_lahir','$email','$telepon','$gender','$alamat','$telepon_wali',
        '$tingkatan','$username','$password','$status','$foto','$role')";
        $hasil = mysqli_query($koneksi, $sql);
    }
}

if ($hasil) {
    header("location: strukturorganisasi.php");
}
?>
