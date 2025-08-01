<?php
$koneksi= mysqli_connect("localhost","root","","jokotole");

$id_aktor = $_POST['id_aktor'];
$nama = $_POST['nama'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$telepon = $_POST['telepon'];
$gender = $_POST['gender'];
$alamat = $_POST['alamat'];
$status = $_POST['status'];
$foto = $_FILES['foto']['name'];

if($foto != ""){
    $ekstensiboleh = array('png','jpg','jpeg');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    $angkaacak = rand(1, 999);
    $foto_baru = $angkaacak.'-'.$foto;

    if (in_array($ekstensi, $ekstensiboleh) === true) {
        move_uploaded_file($file_tmp, '../../dist/img/'.$foto_baru);

        $sql="UPDATE aktor SET nama='$nama', tanggal_lahir='$tanggal_lahir', telepon='$telepon', gender='$gender', alamat='$alamat', status='$status', foto='$foto' WHERE id_aktor=$id_aktor";
        $hasil=mysqli_query($koneksi,$sql);
    }
}else {
    // Jika tidak ada foto yang diunggah, update tanpa menyertakan kolom foto
    $sql = "UPDATE aktor SET nama='$nama', tanggal_lahir='$tanggal_lahir', telepon='$telepon', gender='$gender', alamat='$alamat', status='$status' WHERE id_aktor=$id_aktor";
    $hasil = mysqli_query($koneksi, $sql);
}

if ($hasil){
    header("location:strukturorganisasi.php");
 }

?>