<?php
$koneksi= mysqli_connect("localhost","root","","jokotole");

$id_prestasi = $_POST['id_prestasi'];
$nama_prestasi = $_POST['nama_prestasi'];
$tingkat_prestasi = $_POST['tingkat_prestasi'];
$deskripsi_prestasi = $_POST['deskripsi_prestasi'];
$murid_id = $_POST['murid_id'];
$foto_prestasi = $_FILES['foto_prestasi']['name'];

if($foto_prestasi != ""){
    $ekstensiboleh = array('png','jpg');
    $x = explode('.', $foto_prestasi);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto_prestasi']['tmp_name'];
    $angkaacak = rand(1, 999);
    $foto_baru = $angkaacak.'-'.$foto_prestasi;

    if (in_array($ekstensi, $ekstensiboleh) === true) {
        move_uploaded_file($file_tmp, '../../dist/img/'.$foto_baru);

        $sql="UPDATE galeri_prestasi SET nama_prestasi='$nama_prestasi', tingkat_prestasi='$tingkat_prestasi', deskripsi_prestasi='$deskripsi_prestasi', murid_id='$murid_id', foto_prestasi='$foto_prestasi' WHERE id_prestasi=$id_prestasi";
        $hasil=mysqli_query($koneksi,$sql);
    }
}else {
    // Jika tidak ada foto yang diunggah, update tanpa menyertakan kolom foto_prestasi
    $sql = "UPDATE galeri_prestasi SET nama_prestasi='$nama_prestasi', tingkat_prestasi='$tingkat_prestasi', deskripsi_prestasi='$deskripsi_prestasi', murid_id='$murid_id' WHERE id_prestasi=$id_prestasi";
    $hasil = mysqli_query($koneksi, $sql);
}

if ($hasil){
    header("location:galeriprestasi.php");
 }

?>