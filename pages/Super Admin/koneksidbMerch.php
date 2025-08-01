<?php
// session_start();
// if (!isset($_SESSION['nama']) && !isset($_SESSION['id_aktor'])) {
//     header("Location: index.php");
// }
// Koneksi ke Data Base
$conn = mysqli_connect("localhost", "root", "", "jokotole");


// fungsi query sintak MySql ke Data Base
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


// fungsi tambah data merchandise
function add($data)
{
    global $conn;

    // Ambil Data dari Tiap Elemen pada form
    $nama_merchandise = htmlspecialchars($data["nama_merchandise"]);
    $harga_merchandise = htmlspecialchars($data["harga_merchandise"]);
    $deskripsi_merchandise = htmlspecialchars($data["deskripsi_merchandise"]);

    // upload gambar
    $foto_merchandise = upload();
    if (!$foto_merchandise) {
        return false;
    }

    // Buat Query Insert untuk menambah data ke database
    $query = "INSERT INTO merchandise
                VALUES
                ('', '$nama_merchandise', '$harga_merchandise', '$deskripsi_merchandise', '$foto_merchandise')
                ";

    mysqli_query($conn, $query);


    // Kirim kode eror atau tidak
    return mysqli_affected_rows($conn);
}

// fungsi upload Data Gambar
function upload()
{
    $namaFile = $_FILES['foto_merchandise']['name'];
    $ukuranFile = $_FILES['foto_merchandise']['size'];
    $error = $_FILES['foto_merchandise']['error'];
    $tmpName = $_FILES['foto_merchandise']['tmp_name'];

    // Cek apakah tidak ada gambar yang di upload ?
    if ($error === 4) {
        echo "<script>
                alert('Pilih Gambar Terlebih Dahulu');
            </script>";
        return false;
    }

    // Cek apakah yang di upload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
    $ekstensiGambar = explode('.', $namaFile); // explode = memecah string menjadi array
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // strtolower = memaksa string menjadi huruf kecil
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Yang Anda Upload Bukan Gambar');
            </script>";
        return false;
    }

    // Cek jika ukurannya terlalu besar
    if ($ukuranFile > 1000000) {
        echo "<script>
                alert('Ukuran Gambar Terlalu Besar');
            </script>";
        return false;
    }

    // Lolos pengecekan, gambar siap di upload
    // Generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    // var_dump($namaFileBaru); die;

    move_uploaded_file($tmpName, '../../dist/img/' . $namaFileBaru);

    return $namaFileBaru;
}


// fungsi Hapus data merchandise
function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM merchandise WHERE id_merchandise = $id");
    return mysqli_affected_rows($conn);
}

// fungsi Update data merchandise
function update($data)
{
    global $conn;

    // Ambil Data dari Tiap Elemen pada form
    $id_merchandise = $data["id_merchandise"];
    $nama_merchandise = htmlspecialchars($data["nama_merchandise"]);
    $harga_merchandise = htmlspecialchars($data["harga_merchandise"]);
    $deskripsi_merchandise = htmlspecialchars($data["deskripsi_merchandise"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah use pilih gambar baru atau tidak
    if ($_FILES['foto_merchandise']['error'] === 4) {
        $foto_merchandise = $gambarLama;
    } else {
        $foto_merchandise = upload();
    }


    // Buat Query Insert untuk menambah data ke database
    $query = "UPDATE merchandise SET
                nama_merchandise = '$nama_merchandise',
                harga_merchandise = '$harga_merchandise',
                deskripsi_merchandise = '$deskripsi_merchandise',
                foto_merchandise = '$foto_merchandise'
                WHERE id_merchandise = $id_merchandise
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editwa($data)
{
    global $conn;

    $no_hp = htmlspecialchars($data["no_hp"]);

    mysqli_query($conn, "DELETE FROM penjual");

    $query = "INSERT INTO penjual
                VALUES
                ('', '$no_hp')
                ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}
